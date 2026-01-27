<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function create(Quiz $quiz)
    {
        return view('admin.questions.create', compact('quiz'));
    }

    public function store(Request $request, Quiz $quiz)
    {
        $validated = $request->validate([
            'question' => 'required|string',
            'options' => 'required|array|min:2|max:4',
            'options.*' => 'required|string',
            'correct_answer' => 'required|integer|min:0|max:3',
            'explanation' => 'nullable|string',
            'order' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_draft' => 'nullable|boolean',
        ]);

        $validated['quiz_id'] = $quiz->id;
        $validated['is_draft'] = $request->boolean('is_draft');

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('quiz-questions', 'public');
            $validated['image'] = $imagePath;
        }

        QuizQuestion::create($validated);

        return redirect()->route('admin.quizzes.show', $quiz)
            ->with('success', 'Question created successfully!');
    }

    public function edit(QuizQuestion $question)
    {
        return view('admin.questions.edit', compact('question'));
    }

    public function update(Request $request, QuizQuestion $question)
    {
        $validated = $request->validate([
            'question' => 'required|string',
            'options' => 'required|array|min:2|max:4',
            'options.*' => 'required|string',
            'correct_answer' => 'required|integer|min:0|max:3',
            'explanation' => 'nullable|string',
            'order' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_draft' => 'nullable|boolean',
            'remove_image' => 'nullable|boolean',
        ]);

        $validated['is_draft'] = $request->boolean('is_draft');

        // Handle image removal
        if ($request->boolean('remove_image') && $question->image) {
            \Storage::disk('public')->delete($question->image);
            $validated['image'] = null;
        }

        // Handle new image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($question->image) {
                \Storage::disk('public')->delete($question->image);
            }
            $imagePath = $request->file('image')->store('quiz-questions', 'public');
            $validated['image'] = $imagePath;
        }

        $question->update($validated);

        return redirect()->route('admin.quizzes.show', $question->quiz_id)
            ->with('success', 'Question updated successfully!');
    }

    public function destroy(QuizQuestion $question)
    {
        $quizId = $question->quiz_id;
        
        // Delete image if exists
        if ($question->image) {
            \Storage::disk('public')->delete($question->image);
        }
        
        $question->delete();

        return redirect()->route('admin.quizzes.show', $quizId)
            ->with('success', 'Question deleted successfully!');
    }

    public function showDrafts(Quiz $quiz)
    {
        // Get all draft questions that are not assigned to this quiz
        $draftQuestions = QuizQuestion::where('is_draft', true)
            ->where('quiz_id', '!=', $quiz->id)
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('admin.questions.drafts', compact('quiz', 'draftQuestions'));
    }

    public function addDraft(Request $request, Quiz $quiz, QuizQuestion $question)
    {
        // Clone the draft question to the current quiz
        $newQuestion = $question->replicate();
        $newQuestion->quiz_id = $quiz->id;
        $newQuestion->is_draft = false; // Automatically publish when adding to quiz
        $newQuestion->order = $quiz->questions()->count() + 1;
        $newQuestion->save();

        return redirect()->route('admin.quizzes.show', $quiz)
            ->with('success', 'Question added from draft successfully!');
    }

    public function showImport(Quiz $quiz)
    {
        return view('admin.questions.import', compact('quiz'));
    }

    public function importExcel(Request $request, Quiz $quiz)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls,csv|max:2048',
        ]);

        try {
            $file = $request->file('excel_file');
            $extension = $file->getClientOriginalExtension();
            
            // Process based on file type
            if ($extension === 'csv') {
                $data = $this->readCsvFile($file);
            } else {
                // For Excel files, we'll read as CSV after user converts
                return back()->withErrors(['excel_file' => 'Please upload a CSV file. You can export your Excel file as CSV.']);
            }

            $results = $this->processImportData($data, $quiz);
            
            return redirect()->route('admin.quizzes.show', $quiz)
                ->with('import_results', $results);
                
        } catch (\Exception $e) {
            return back()->withErrors(['excel_file' => 'Error processing file: ' . $e->getMessage()]);
        }
    }

    private function readCsvFile($file)
    {
        $data = [];
        $handle = fopen($file->getRealPath(), 'r');
        
        // Skip header row
        fgetcsv($handle);
        
        while (($row = fgetcsv($handle)) !== false) {
            if (count($row) >= 6) { // Minimum columns needed
                $data[] = $row;
            }
        }
        
        fclose($handle);
        return $data;
    }

    private function processImportData($data, $quiz)
    {
        $success = 0;
        $failed = 0;
        $errors = [];
        
        foreach ($data as $index => $row) {
            $rowNumber = $index + 2; // +2 because of header row and 0-index
            
            try {
                // Parse row data
                $question = trim($row[0] ?? '');
                $optionA = trim($row[1] ?? '');
                $optionB = trim($row[2] ?? '');
                $optionC = trim($row[3] ?? '');
                $optionD = trim($row[4] ?? '');
                $correctAnswer = strtoupper(trim($row[5] ?? ''));
                $explanation = trim($row[6] ?? '');
                $isDraft = strtolower(trim($row[7] ?? 'no'));
                
                // Validation
                if (empty($question)) {
                    throw new \Exception('Question is required');
                }
                
                $options = array_filter([$optionA, $optionB, $optionC, $optionD]);
                if (count($options) < 2) {
                    throw new \Exception('At least 2 options are required');
                }
                
                if (!in_array($correctAnswer, ['A', 'B', 'C', 'D'])) {
                    throw new \Exception('Correct answer must be A, B, C, or D');
                }
                
                // Map correct answer letter to index
                $correctIndex = ord($correctAnswer) - ord('A');
                
                // Check if correct answer option exists
                if (!isset($options[$correctIndex]) || empty($options[$correctIndex])) {
                    throw new \Exception('Correct answer option is empty');
                }
                
                // Create question
                QuizQuestion::create([
                    'quiz_id' => $quiz->id,
                    'question' => $question,
                    'options' => array_values($options), // Re-index array
                    'correct_answer' => $correctIndex,
                    'explanation' => $explanation ?: null,
                    'order' => $quiz->questions()->count() + 1,
                    'is_draft' => in_array($isDraft, ['yes', 'y', '1', 'true']),
                ]);
                
                $success++;
                
            } catch (\Exception $e) {
                $failed++;
                $errors[] = "Row {$rowNumber}: " . $e->getMessage();
            }
        }
        
        return [
            'success' => $success,
            'failed' => $failed,
            'errors' => $errors,
        ];
    }

    public function downloadTemplate()
    {
        $csv = "Question,Option A,Option B,Option C,Option D,Correct Answer,Explanation,Is Draft\n";
        $csv .= "What is HTML?,HyperText Markup Language,High Tech Modern Language,Home Tool Making Language,,A,HTML is used to create web pages,No\n";
        $csv .= "What does CSS stand for?,Cascading Style Sheets,Computer Style Sheets,Creative Style Sheets,Colorful Style Sheets,A,CSS is used for styling web pages,No\n";
        
        $filename = 'quiz-questions-template.csv';
        
        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', "attachment; filename=\"{$filename}\"");
    }
}