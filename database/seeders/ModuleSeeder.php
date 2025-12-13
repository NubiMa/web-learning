<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;

class ModuleSeeder extends Seeder
{
    public function run(): void
    {
        $modules = [
            [
                'title' => 'HTML',
                'slug' => 'html',
                'description' => 'Pelajari struktur dan markup dasar untuk membuat halaman web. HTML adalah fondasi dari semua website.',
                'icon' => '📄',
                'color' => 'orange',
                'order' => 1,
            ],
            [
                'title' => 'CSS',
                'slug' => 'css',
                'description' => 'Pelajari styling, layout, dan desain visual untuk membuat website yang menarik dan responsive.',
                'icon' => '🎨',
                'color' => 'blue',
                'order' => 2,
            ],
            [
                'title' => 'JavaScript',
                'slug' => 'javascript',
                'description' => 'Pelajari programming logic, interaktivitas, dan manipulasi DOM untuk membuat website dinamis.',
                'icon' => '⚡',
                'color' => 'yellow',
                'order' => 3,
            ],
            [
                'title' => 'PHP',
                'slug' => 'php',
                'description' => 'Pelajari server-side programming untuk membuat website dinamis dengan database dan backend logic.',
                'icon' => '🐘',
                'color' => 'purple',
                'order' => 4,
            ],
        ];

        foreach ($modules as $module) {
            Module::create($module);
        }
    }
}