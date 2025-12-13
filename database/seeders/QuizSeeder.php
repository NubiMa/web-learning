<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;
use App\Models\Quiz;
use App\Models\QuizQuestion;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        // HTML Quiz
        $htmlModule = Module::where('slug', 'html')->first();
        $htmlQuiz = Quiz::create([
            'module_id' => $htmlModule->id,
            'title' => 'HTML Quiz',
            'description' => 'Test your HTML knowledge',
            'passing_score' => 70,
        ]);

        $htmlQuestions = [
            [
                'question' => 'Apa kepanjangan dari HTML?',
                'options' => ['HyperText Markup Language', 'HighText Machine Language', 'HyperTransfer Markup Language', 'Home Tool Markup Language'],
                'correct_answer' => 0,
            ],
            [
                'question' => 'Tag HTML mana yang digunakan untuk membuat heading paling besar?',
                'options' => ['<heading>', '<h6>', '<h1>', '<head>'],
                'correct_answer' => 2,
            ],
            [
                'question' => 'Atribut apa yang digunakan untuk menentukan tujuan link?',
                'options' => ['src', 'href', 'link', 'url'],
                'correct_answer' => 1,
            ],
        ];

        foreach ($htmlQuestions as $index => $q) {
            QuizQuestion::create([
                'quiz_id' => $htmlQuiz->id,
                'question' => $q['question'],
                'options' => $q['options'],
                'correct_answer' => $q['correct_answer'],
                'order' => $index + 1,
            ]);
        }

        // CSS Quiz
        $cssModule = Module::where('slug', 'css')->first();
        $cssQuiz = Quiz::create([
            'module_id' => $cssModule->id,
            'title' => 'CSS Quiz',
            'description' => 'Test your CSS knowledge',
            'passing_score' => 70,
        ]);

        $cssQuestions = [
            [
                'question' => 'Cara terbaik untuk menambahkan CSS ke HTML adalah?',
                'options' => ['Inline style', 'Internal style', 'External CSS file', 'Semua sama saja'],
                'correct_answer' => 2,
            ],
            [
                'question' => 'Property CSS mana yang mengontrol jarak DALAM elemen?',
                'options' => ['margin', 'padding', 'border', 'gap'],
                'correct_answer' => 1,
            ],
        ];

        foreach ($cssQuestions as $index => $q) {
            QuizQuestion::create([
                'quiz_id' => $cssQuiz->id,
                'question' => $q['question'],
                'options' => $q['options'],
                'correct_answer' => $q['correct_answer'],
                'order' => $index + 1,
            ]);
        }

        // ===== JAVASCRIPT QUIZ =====
        $jsModule = Module::where('slug', 'javascript')->first();
        $jsQuiz = Quiz::create([
            'module_id' => $jsModule->id,
            'title' => 'JavaScript Quiz',
            'description' => 'Test your JavaScript knowledge',
            'passing_score' => 70,
        ]);

        $jsQuestions = [
            [
                'question' => 'Apa perbedaan antara let dan const?',
                'options' => ['Tidak ada perbedaan', 'let dapat diubah, const tidak', 'const lebih cepat', 'let untuk number, const untuk string'],
                'correct_answer' => 1,
                'explanation' => 'let digunakan untuk variabel yang nilainya bisa berubah, sedangkan const untuk nilai konstan yang tidak bisa diubah setelah dideklarasikan.',
            ],
            [
                'question' => 'Operator mana yang memeriksa nilai DAN tipe data?',
                'options' => ['==', '===', '=', '!='],
                'correct_answer' => 1,
                'explanation' => '=== adalah strict equality operator yang memeriksa nilai DAN tipe data. == hanya memeriksa nilai dengan type coercion.',
            ],
            [
                'question' => 'Method array mana yang mengubah setiap element tanpa mengubah array asli?',
                'options' => ['push()', 'map()', 'splice()', 'sort()'],
                'correct_answer' => 1,
                'explanation' => 'map() membuat array baru dengan hasil transformasi setiap element. push, splice, dan sort mengubah array asli.',
            ],
            [
                'question' => 'Apa fungsi dari addEventListener()?',
                'options' => ['Membuat element baru', 'Mendengarkan dan merespons events', 'Mengubah style element', 'Menghapus element'],
                'correct_answer' => 1,
                'explanation' => 'addEventListener() digunakan untuk menambahkan event listener ke element agar bisa merespons user interactions.',
            ],
            [
                'question' => 'Keyword apa yang digunakan untuk menunggu Promise selesai?',
                'options' => ['wait', 'async', 'await', 'promise'],
                'correct_answer' => 2,
                'explanation' => 'await digunakan di dalam async function untuk menunggu Promise selesai sebelum melanjutkan eksekusi.',
            ],
            [
                'question' => 'Method mana untuk memilih element berdasarkan CSS selector?',
                'options' => ['getElementById()', 'querySelector()', 'getElementsByClass()', 'selectElement()'],
                'correct_answer' => 1,
                'explanation' => 'querySelector() adalah method modern yang bisa memilih element menggunakan CSS selector apapun.',
            ],
            [
                'question' => 'Apa output dari: [1,2,3].reduce((a,b) => a+b, 0)?',
                'options' => ['123', '6', '[1,2,3]', 'undefined'],
                'correct_answer' => 1,
                'explanation' => 'reduce() menjumlahkan semua element array. 0+1+2+3 = 6.',
            ],
            [
                'question' => 'Apa fungsi dari this keyword di JavaScript?',
                'options' => ['Merujuk ke parent element', 'Merujuk ke object yang memanggil function', 'Membuat variable baru', 'Menghapus object'],
                'correct_answer' => 1,
                'explanation' => 'this merujuk ke object yang sedang mengeksekusi atau memanggil function tersebut.',
            ],
        ];

        foreach ($jsQuestions as $index => $q) {
            QuizQuestion::create([
                'quiz_id' => $jsQuiz->id,
                'question' => $q['question'],
                'options' => $q['options'],
                'correct_answer' => $q['correct_answer'],
                'explanation' => $q['explanation'] ?? null,
                'order' => $index + 1,
            ]);
        }

        // ===== PHP QUIZ =====
        $phpModule = Module::where('slug', 'php')->first();
        $phpQuiz = Quiz::create([
            'module_id' => $phpModule->id,
            'title' => 'PHP Quiz',
            'description' => 'Test your PHP knowledge',
            'passing_score' => 70,
        ]);

        $phpQuestions = [
            [
                'question' => 'Apa yang digunakan untuk memulai kode PHP?',
                'options' => ['<php>', '<?php', '<script php>', '<?php?>'],
                'correct_answer' => 1,
                'explanation' => 'PHP code dimulai dengan <?php dan diakhiri dengan ?> (opsional di akhir file).',
            ],
            [
                'question' => 'Superglobal mana yang digunakan untuk mengambil data dari form POST?',
                'options' => ['$_GET', '$_POST', '$_REQUEST', '$_FORM'],
                'correct_answer' => 1,
                'explanation' => '$_POST digunakan untuk mengambil data dari form dengan method POST. $_GET untuk method GET.',
            ],
            [
                'question' => 'Function mana yang digunakan untuk koneksi MySQL?',
                'options' => ['mysql_connect()', 'new mysqli()', 'connect_db()', 'db_connect()'],
                'correct_answer' => 1,
                'explanation' => 'new mysqli() adalah cara modern untuk koneksi MySQL di PHP. mysql_connect() sudah deprecated.',
            ],
            [
                'question' => 'Kenapa prepared statements lebih aman?',
                'options' => ['Lebih cepat', 'Mencegah SQL injection', 'Lebih mudah', 'Otomatis sanitize'],
                'correct_answer' => 1,
                'explanation' => 'Prepared statements memisahkan SQL query dari data, sehingga mencegah SQL injection attacks.',
            ],
            [
                'question' => 'Function untuk memulai session?',
                'options' => ['start_session()', 'session_start()', 'begin_session()', 'init_session()'],
                'correct_answer' => 1,
                'explanation' => 'session_start() harus dipanggil di awal file untuk memulai atau melanjutkan session.',
            ],
            [
                'question' => 'Operator mana untuk strict comparison di PHP?',
                'options' => ['==', '===', '!=', '!=='],
                'correct_answer' => 1,
                'explanation' => '=== membandingkan nilai DAN tipe data. == hanya membandingkan nilai dengan type juggling.',
            ],
            [
                'question' => 'Apa fungsi dari htmlspecialchars()?',
                'options' => ['Format HTML', 'Prevent XSS attacks', 'Create HTML tags', 'Parse HTML'],
                'correct_answer' => 1,
                'explanation' => 'htmlspecialchars() mengkonversi special characters ke HTML entities, mencegah XSS attacks.',
            ],
            [
                'question' => 'Method mana untuk menambah element di akhir array?',
                'options' => ['array_add()', 'array_push()', 'array_append()', 'array_insert()'],
                'correct_answer' => 1,
                'explanation' => 'array_push() menambahkan satu atau lebih element di akhir array.',
            ],
        ];

        foreach ($phpQuestions as $index => $q) {
            QuizQuestion::create([
                'quiz_id' => $phpQuiz->id,
                'question' => $q['question'],
                'options' => $q['options'],
                'correct_answer' => $q['correct_answer'],
                'explanation' => $q['explanation'] ?? null,
                'order' => $index + 1,
            ]);
        }
    }
}