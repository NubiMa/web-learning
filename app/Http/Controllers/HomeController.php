<?php
// app/Http/Controllers/HomeController.php (UPDATED)

namespace App\Http\Controllers;

use App\Models\Module;

class HomeController extends Controller
{
    public function index()
    {
        // If user is logged in, redirect to dashboard
        if (auth()->check()) {
            if (auth()->user()->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('user.dashboard');
        }

        // Show landing page for guests with modules
        $modules = Module::where('is_active', true)
            ->withCount('chapters')
            ->orderBy('order')
            ->get();

        return view('welcome', compact('modules'));
    }
}