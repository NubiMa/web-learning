<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ModuleController extends Controller
{
    public function index()
    {
        $modules = Module::withCount('chapters')->orderBy('order')->get();
        return view('admin.modules.index', compact('modules'));
    }

    public function create()
    {
        return view('admin.modules.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:50',
            'color' => 'required|string|max:50',
            'order' => 'required|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_active'] = true;

        Module::create($validated);

        return redirect()->route('admin.modules.index')
            ->with('success', 'Module created successfully!');
    }

    public function show(Module $module)
    {
        $module->load(['chapters' => function($query) {
            $query->orderBy('order');
        }, 'quizzes']);

        return view('admin.modules.show', compact('module'));
    }

    public function edit(Module $module)
    {
        return view('admin.modules.edit', compact('module'));
    }

    public function update(Request $request, Module $module)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:50',
            'color' => 'required|string|max:50',
            'order' => 'required|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        $module->update($validated);

        return redirect()->route('admin.modules.index')
            ->with('success', 'Module updated successfully!');
    }

    public function destroy(Module $module)
    {
        $module->delete();

        return redirect()->route('admin.modules.index')
            ->with('success', 'Module deleted successfully!');
    }

    public function toggle(Module $module)
    {
        $module->update(['is_active' => !$module->is_active]);

        return back()->with('success', 'Module status updated!');
    }
}