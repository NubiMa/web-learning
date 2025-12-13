<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChapterController extends Controller
{
    public function index()
    {
        $chapters = Chapter::with('module')->orderBy('module_id')->orderBy('order')->paginate(20);
        return view('admin.chapters.index', compact('chapters'));
    }

    public function create()
    {
        $modules = Module::orderBy('order')->get();
        return view('admin.chapters.create', compact('modules'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'module_id' => 'required|exists:modules,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'code_example' => 'nullable|string',
            'explanation' => 'nullable|string',
            'order' => 'required|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_active'] = true;

        Chapter::create($validated);

        return redirect()->route('admin.chapters.index')
            ->with('success', 'Chapter created successfully!');
    }

    public function show(Chapter $chapter)
    {
        $chapter->load('module');
        return view('admin.chapters.show', compact('chapter'));
    }

    public function edit(Chapter $chapter)
    {
        $modules = Module::orderBy('order')->get();
        return view('admin.chapters.edit', compact('chapter', 'modules'));
    }

    public function update(Request $request, Chapter $chapter)
    {
        $validated = $request->validate([
            'module_id' => 'required|exists:modules,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'code_example' => 'nullable|string',
            'explanation' => 'nullable|string',
            'order' => 'required|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        $chapter->update($validated);

        return redirect()->route('admin.chapters.index')
            ->with('success', 'Chapter updated successfully!');
    }

    public function destroy(Chapter $chapter)
    {
        $chapter->delete();

        return redirect()->route('admin.chapters.index')
            ->with('success', 'Chapter deleted successfully!');
    }

    public function toggle(Chapter $chapter)
    {
        $chapter->update(['is_active' => !$chapter->is_active]);

        return back()->with('success', 'Chapter status updated!');
    }
}