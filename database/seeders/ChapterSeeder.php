<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;
use App\Models\Chapter;

class ChapterSeeder extends Seeder
{
    public function run(): void
    {
        // HTML Chapters
        $htmlModule = Module::where('slug', 'html')->first();
        
        $htmlChapters = [
            [
                'title' => 'Pengenalan HTML',
                'content' => 'HTML (HyperText Markup Language) adalah bahasa markup standar untuk membuat halaman web. HTML bukan bahasa pemrograman, melainkan bahasa markup yang mendefinisikan struktur konten web.',
                'code_example' => '<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Halaman Pertama Saya</title>
</head>
<body>
    <h1>Hello World!</h1>
    <p>Ini adalah paragraf pertama saya.</p>
</body>
</html>',
                'explanation' => 'Struktur dasar HTML terdiri dari DOCTYPE, html, head, dan body. Setiap elemen memiliki peran spesifik dalam membangun halaman web.',
                'order' => 1,
            ],
            [
                'title' => 'Tag & Elemen HTML',
                'content' => 'Tag HTML adalah instruksi yang memberitahu browser cara menampilkan konten. Tag biasanya berpasangan (opening & closing tag).',
                'code_example' => '<!-- Heading -->
<h1>Heading 1</h1>
<h2>Heading 2</h2>

<!-- Paragraph -->
<p>Ini adalah paragraf dengan <strong>teks tebal</strong> dan <em>teks miring</em>.</p>

<!-- List -->
<ul>
    <li>Item 1</li>
    <li>Item 2</li>
</ul>

<!-- Link -->
<a href="https://google.com">Kunjungi Google</a>

<!-- Image -->
<img src="image.jpg" alt="Deskripsi gambar">',
                'explanation' => 'Tag heading (h1-h6) untuk judul, p untuk paragraf, strong/em untuk emphasis, ul/ol untuk list, a untuk link, dan img untuk gambar.',
                'order' => 2,
            ],
            [
                'title' => 'Form & Input',
                'content' => 'Form digunakan untuk mengumpulkan input dari user. HTML menyediakan berbagai jenis input untuk kebutuhan berbeda.',
                'code_example' => '<form action="/submit" method="POST">
    <label for="nama">Nama:</label>
    <input type="text" id="nama" name="nama" required>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    
    <label for="password">Password:</label>
    <input type="password" id="password" name="password">
    
    <button type="submit">Kirim</button>
</form>',
                'explanation' => 'Form memiliki atribut action (URL tujuan) dan method (GET/POST). Input memiliki type yang berbeda untuk validasi otomatis browser.',
                'order' => 3,
            ],
        ];

        foreach ($htmlChapters as $chapter) {
            $chapter['module_id'] = $htmlModule->id;
            $chapter['slug'] = \Illuminate\Support\Str::slug($chapter['title']);
            Chapter::create($chapter);
        }

        // CSS Chapters
        $cssModule = Module::where('slug', 'css')->first();
        
        $cssChapters = [
            [
                'title' => 'Pengenalan CSS',
                'content' => 'CSS (Cascading Style Sheets) adalah bahasa stylesheet yang digunakan untuk mengatur tampilan dan layout halaman web.',
                'code_example' => '/* External CSS (recommended) */
p {
    color: blue;
    font-size: 16px;
}

.highlight {
    background-color: yellow;
}

#header {
    font-size: 24px;
}',
                'explanation' => 'Ada 3 cara menulis CSS: inline, internal, dan external. External CSS adalah yang paling recommended untuk maintainability.',
                'order' => 1,
            ],
            [
                'title' => 'Selectors & Specificity',
                'content' => 'Selector adalah cara kita memilih elemen HTML yang ingin diberi style. CSS memiliki berbagai jenis selector.',
                'code_example' => '/* Element Selector */
p { color: black; }

/* Class Selector */
.highlight { background-color: yellow; }

/* ID Selector */
#header { font-size: 24px; }

/* Pseudo-class */
a:hover { color: red; }',
                'explanation' => 'Specificity: Inline (1000) > ID (100) > Class (10) > Element (1). Jika ada conflict, style dengan specificity lebih tinggi yang menang.',
                'order' => 2,
            ],
            [
                'title' => 'Box Model',
                'content' => 'Box Model adalah konsep fundamental CSS yang menjelaskan bagaimana elemen HTML diperlakukan sebagai box.',
                'code_example' => '.box {
    width: 300px;
    height: 200px;
    padding: 20px;
    border: 2px solid #333;
    margin: 15px;
    box-sizing: border-box;
}',
                'explanation' => 'Total lebar elemen = width + padding + border + margin. Gunakan box-sizing: border-box agar width sudah termasuk padding dan border.',
                'order' => 3,
            ],
        ];

        foreach ($cssChapters as $chapter) {
            $chapter['module_id'] = $cssModule->id;
            $chapter['slug'] = \Illuminate\Support\Str::slug($chapter['title']);
            Chapter::create($chapter);
        }

        // ===== JAVASCRIPT CHAPTERS (MORE COMPLETE) =====
        $jsModule = Module::where('slug', 'javascript')->first();

        $jsChapters = [
            [
                'title' => 'Pengenalan JavaScript',
                'content' => 'JavaScript adalah bahasa pemrograman yang membuat website interaktif. JS berjalan di browser (client-side) dan bisa juga di server dengan Node.js.',
                'code_example' => '// Output ke console
        console.log("Hello World!");

        // Variables
        let name = "John";
        const PI = 3.14159;
        var oldWay = "avoid"; // hindari var

        // Function
        function greet(name) {
            return `Hello, ${name}!`;
        }

        console.log(greet("Alice")); // "Hello, Alice!"',
                'explanation' => 'JavaScript dijalankan oleh browser. Console.log() untuk debugging. Gunakan const untuk nilai tetap, let untuk nilai yang berubah. Hindari var karena scope issues.',
                'order' => 1,
            ],
            [
                'title' => 'Variables & Data Types',
                'content' => 'JavaScript memiliki tipe data primitif: string, number, boolean, null, undefined, symbol, dan bigint. Plus tipe reference: object, array, function.',
                'code_example' => '// Primitives
        let str = "Hello";              // String
        let num = 42;                   // Number
        let bool = true;                // Boolean
        let nothing = null;             // Null
        let undef;                      // Undefined

        // Objects
        let person = {
            name: "John",
            age: 25,
            greet() {
                return `Hi, I am ${this.name}`;
            }
        };

        // Arrays
        let numbers = [1, 2, 3, 4, 5];
        let mixed = [1, "two", true, null, {key: "value"}];

        // Type checking
        console.log(typeof str);        // "string"
        console.log(Array.isArray(numbers)); // true',
                'explanation' => 'JavaScript adalah dynamically typed. typeof untuk check tipe primitif. Array.isArray() untuk check array. Objects bisa punya methods.',
                'order' => 2,
            ],
            [
                'title' => 'Control Flow & Loops',
                'content' => 'Control flow mengatur alur eksekusi code. JavaScript punya if-else, switch, for, while, do-while untuk control flow.',
                'code_example' => '// If-Else
        let score = 85;
        if (score >= 90) {
            console.log("A");
        } else if (score >= 80) {
            console.log("B");
        } else {
            console.log("C");
        }

        // Switch
        let day = "Monday";
        switch(day) {
            case "Monday":
                console.log("Start of week");
                break;
            case "Friday":
                console.log("Almost weekend!");
                break;
            default:
                console.log("Regular day");
        }

        // For loop
        for (let i = 0; i < 5; i++) {
            console.log(i);
        }

        // While loop
        let count = 0;
        while (count < 3) {
            console.log(count);
            count++;
        }

        // For...of (arrays)
        let fruits = ["apple", "banana"];
        for (let fruit of fruits) {
            console.log(fruit);
        }',
                'explanation' => 'If-else untuk kondisi, switch untuk banyak case. For loop paling umum. While untuk kondisi dynamic. For...of untuk iterate arrays.',
                'order' => 3,
            ],
            [
                'title' => 'Functions & Scope',
                'content' => 'Functions adalah reusable code blocks. JavaScript punya function declaration, expression, arrow function, dan IIFE.',
                'code_example' => '// Function Declaration
        function add(a, b) {
            return a + b;
        }

        // Function Expression
        const multiply = function(a, b) {
            return a * b;
        };

        // Arrow Function
        const divide = (a, b) => a / b;

        // Arrow with body
        const calculate = (a, b) => {
            let sum = a + b;
            let product = a * b;
            return {sum, product};
        };

        // Default Parameters
        function greet(name = "Guest") {
            return `Hello, ${name}`;
        }

        // Rest Parameters
        function sum(...numbers) {
            return numbers.reduce((total, num) => total + num, 0);
        }
        console.log(sum(1, 2, 3, 4)); // 10

        // Scope
        let global = "I am global";
        function testScope() {
            let local = "I am local";
            console.log(global);  // OK
            console.log(local);   // OK
        }
        // console.log(local);  // Error!',
                'explanation' => 'Arrow functions lebih ringkas. Rest parameters untuk flexible args. Variables punya function scope (let/const) atau block scope.',
                'order' => 4,
            ],
            [
                'title' => 'DOM Manipulation',
                'content' => 'DOM (Document Object Model) adalah representasi HTML sebagai tree. JavaScript bisa akses dan modify DOM.',
                'code_example' => '// Selecting Elements
        const el = document.getElementById("myId");
        const el2 = document.querySelector(".myClass");
        const allP = document.querySelectorAll("p");

        // Creating Elements
        const div = document.createElement("div");
        div.textContent = "Hello!";
        div.className = "my-class";
        div.id = "myDiv";

        // Adding to DOM
        document.body.appendChild(div);

        // Modifying Content
        el.textContent = "New text";
        el.innerHTML = "<strong>Bold text</strong>";

        // Modifying Styles
        el.style.color = "blue";
        el.style.fontSize = "20px";

        // Working with Classes
        el.classList.add("active");
        el.classList.remove("hidden");
        el.classList.toggle("visible");

        // Event Listeners
        el.addEventListener("click", () => {
            console.log("Clicked!");
        });

        // Removing Elements
        el.remove();',
                'explanation' => 'querySelector paling flexible. textContent untuk text, innerHTML untuk HTML. classList untuk manage classes. addEventListener untuk events.',
                'order' => 5,
            ],
        ];

        foreach ($jsChapters as $chapter) {
            $chapter['module_id'] = $jsModule->id;
            $chapter['slug'] = \Illuminate\Support\Str::slug($chapter['title']);
            Chapter::create($chapter);
        }

        // ===== PHP CHAPTERS (MORE COMPLETE) =====
        $phpModule = Module::where('slug', 'php')->first();

        $phpChapters = [
            [
                'title' => 'Pengenalan PHP',
                'content' => 'PHP (Hypertext Preprocessor) adalah bahasa server-side scripting. PHP code dijalankan di server dan hasilnya dikirim ke browser sebagai HTML.',
                'code_example' => '<?php
        // Output
        echo "Hello World!";
        print "Hello PHP";

        // Variables
        $name = "John";
        $age = 25;
        $price = 19.99;
        $isActive = true;

        echo "My name is $name";
        echo "I am {$age} years old";

        // Constants
        define("SITE_NAME", "My Website");
        echo SITE_NAME;

        // Comments
        // Single line comment
        # Also single line
        /* Multi-line
        comment */

        // Concatenation
        $first = "Hello";
        $last = "World";
        echo $first . " " . $last;
        ?>',
                'explanation' => 'PHP code dimulai dengan <?php. Variables dimulai dengan $. Gunakan echo atau print untuk output. Constants tidak bisa diubah.',
                'order' => 1,
            ],
            [
                'title' => 'Variables & Data Types',
                'content' => 'PHP adalah loosely typed. Tipe data: string, integer, float, boolean, array, object, NULL, resource.',
                'code_example' => '<?php
        // Data Types
        $string = "Hello";          // String
        $integer = 42;              // Integer
        $float = 3.14;              // Float
        $boolean = true;            // Boolean
        $array = [1, 2, 3];        // Array
        $null = null;               // NULL

        // Type Checking
        var_dump($string);          // string(5) "Hello"
        echo gettype($integer);     // integer

        // Type Casting
        $num = "123";
        $int = (int)$num;          // 123
        $float = (float)$num;      // 123.0
        $str = (string)123;        // "123"

        // Superglobals
        $_GET       // URL parameters
        $_POST      // Form POST data
        $_SESSION   // Session data
        $_COOKIE    // Cookies
        $_SERVER    // Server info
        $_FILES     // Uploaded files

        // Variable Scope
        $globalVar = "Global";

        function test() {
            $localVar = "Local";
            global $globalVar;
            echo $globalVar;  // Accessible
        }
        ?>',
                'explanation' => 'PHP auto-detect tipe. var_dump() untuk debugging. Superglobals accessible dimana saja. Use global keyword untuk access global variables.',
                'order' => 2,
            ],
            [
                'title' => 'Arrays & Loops',
                'content' => 'PHP arrays bisa indexed atau associative. PHP punya powerful array functions.',
                'code_example' => '<?php
        // Indexed Array
        $fruits = ["apple", "banana", "orange"];
        echo $fruits[0];  // "apple"

        // Associative Array
        $person = [
            "name" => "John",
            "age" => 25,
            "city" => "Jakarta"
        ];
        echo $person["name"];  // "John"

        // Multi-dimensional
        $users = [
            ["name" => "John", "age" => 25],
            ["name" => "Jane", "age" => 30]
        ];

        // Array Functions
        count($fruits);              // 3
        array_push($fruits, "mango");
        array_pop($fruits);
        sort($fruits);
        in_array("apple", $fruits);  // true

        // Loops
        // For loop
        for ($i = 0; $i < 5; $i++) {
            echo $i;
        }

        // While loop
        $x = 0;
        while ($x < 5) {
            echo $x;
            $x++;
        }

        // Foreach (arrays)
        foreach ($fruits as $fruit) {
            echo $fruit;
        }

        // Foreach (associative)
        foreach ($person as $key => $value) {
            echo "$key: $value";
        }
        ?>',
                'explanation' => 'Arrays sangat flexible di PHP. count() untuk jumlah elements. Foreach ideal untuk iterate arrays. In_array() untuk check existence.',
                'order' => 3,
            ],
            [
                'title' => 'Functions',
                'content' => 'Functions adalah reusable code blocks. PHP support type declarations dan return types.',
                'code_example' => '<?php
        // Basic Function
        function greet($name) {
            return "Hello, $name!";
        }

        // Default Parameters
        function sayHi($name = "Guest") {
            return "Hi, $name!";
        }

        // Type Declarations (PHP 7+)
        function add(int $a, int $b): int {
            return $a + $b;
        }

        // Variable Arguments
        function sum(...$numbers) {
            return array_sum($numbers);
        }
        echo sum(1, 2, 3, 4);  // 10

        // Pass by Reference
        function increment(&$num) {
            $num++;
        }
        $x = 5;
        increment($x);
        echo $x;  // 6

        // Anonymous Functions
        $multiply = function($a, $b) {
            return $a * $b;
        };

        // Arrow Functions (PHP 7.4+)
        $square = fn($n) => $n * $n;

        // Built-in Functions
        strlen("Hello");              // 5
        strtoupper("hello");          // "HELLO"
        str_replace("a", "b", "cat"); // "cbt"
        explode(",", "a,b,c");        // ["a","b","c"]
        implode(",", [1,2,3]);        // "1,2,3"
        ?>',
                'explanation' => 'Type hints improve code safety. Pass by reference dengan &. Arrow functions lebih ringkas. PHP punya banyak built-in string/array functions.',
                'order' => 4,
            ],
            [
                'title' => 'Form Handling & Validation',
                'content' => 'PHP dapat menerima dan validate data dari form menggunakan $_GET dan $_POST.',
                'code_example' => '<?php
        // Check Request Method
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            // Get Form Data
            $name = $_POST["name"] ?? "";
            $email = $_POST["email"] ?? "";
            $age = $_POST["age"] ?? null;
            
            // Validation
            $errors = [];
            
            if (empty($name)) {
                $errors[] = "Name is required";
            }
            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid email";
            }
            
            if ($age && ($age < 1 || $age > 120)) {
                $errors[] = "Invalid age";
            }
            
            // Sanitization
            $name = htmlspecialchars($name);
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            
            if (empty($errors)) {
                // Process data
                echo "Form submitted!";
            } else {
                foreach ($errors as $error) {
                    echo "<p>$error</p>";
                }
            }
        }
        ?>

        <!-- HTML Form -->
        <form method="POST">
            <input type="text" name="name" required>
            <input type="email" name="email" required>
            <input type="number" name="age">
            <button type="submit">Submit</button>
        </form>',
                'explanation' => 'POST untuk data sensitif. Validate semua input. htmlspecialchars() prevent XSS. filter_var() untuk validation dan sanitization.',
                'order' => 5,
            ],
        ];

        foreach ($phpChapters as $chapter) {
            $chapter['module_id'] = $phpModule->id;
            $chapter['slug'] = \Illuminate\Support\Str::slug($chapter['title']);
            Chapter::create($chapter);
        }
    }   
}
