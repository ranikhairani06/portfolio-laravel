<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Category;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search', '');
        $perPage = (int) $request->query('per_page', 10);

        if (!in_array($perPage, [5, 10, 25])) {
            $perPage = 10;
        }

        $projects = Project::query()
            ->where('title', 'like', '%' . $search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage)
            ->withQueryString();

        return view('projects.index', compact(
            'projects',
            'search',
            'perPage'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $skills = Skill::orderBy('name')->get();

        return view('projects.create', compact(
            'categories',
            'skills'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|min:5|max:255',
            'description' => 'required|string|min:10',
            'category_id' => 'nullable|exists:categories,id',
            'skills' => 'nullable|array',
            'skills.*' => 'integer|distinct|exists:skills,id',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048|dimensions:min_width=400,min_height=300',
        ]);

        $selectedSkills = $validatedData['skills'] ?? [];

        unset($validatedData['skills']);

        if ($request->hasFile('thumbnail')) {
            $validatedData['thumbnail'] = $request->file('thumbnail')
                ->store('projects/thumbnails', 'public');
        }

        $project = Project::create($validatedData);

        // Menyimpan skill yang dipilih
        $project->skills()->sync($selectedSkills);

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::with([
            'category',
            'skills',
            'images'
        ])->findOrFail($id);

        return view('projects.show')->with('project', $project);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::with('skills')->findOrFail($id);

        $categories = Category::orderBy('name')->get();
        $skills = Skill::orderBy('name')->get();

        return view('projects.edit', compact(
            'project',
            'categories',
            'skills'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|min:5|max:255',
            'description' => 'required|string|min:10',
            'category_id' => 'nullable|exists:categories,id',
            'skills' => 'nullable|array',
            'skills.*' => 'integer|distinct|exists:skills,id',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048|dimensions:min_width=400,min_height=300',
        ]);

        $project = Project::findOrFail($id);

        $selectedSkills = $validatedData['skills'] ?? [];

        unset($validatedData['skills']);

        if ($request->hasFile('thumbnail')) {
            if ($project->thumbnail) {
                Storage::disk('public')->delete($project->thumbnail);
            }

            $validatedData['thumbnail'] = $request->file('thumbnail')
                ->store('projects/thumbnails', 'public');
        }

        $project->update($validatedData);

        // Memperbarui skill project
        $project->skills()->sync($selectedSkills);

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
{
    // Hapus file thumbnail dari storage
    if ($project->thumbnail) {
        Storage::disk('public')->delete($project->thumbnail);
    }

    // Hapus seluruh file gambar gallery dari storage
    foreach ($project->images as $image) {
        Storage::disk('public')->delete($image->image);
    }

    // Hapus project dari database
    $project->delete();

    return redirect()
        ->route('projects.index')
        ->with('success', 'Project berhasil dihapus.');
}

    /**
     * Display trashed projects.
     */
    public function trash()
    {
        $projects = Project::onlyTrashed()->get();

        return view('projects.trash')->with('projects', $projects);
    }

    /**
     * Restore a deleted project.
     */
    public function restore(string $id)
    {
        $project = Project::withTrashed()->findOrFail($id);

        $project->restore();

        return redirect()
            ->route('projects.trash')
            ->with('success', 'Project berhasil dipulihkan.');
    }

    /**
     * Permanently delete a project.
     */
    public function forceDelete(string $id)
    {
        $project = Project::withTrashed()->findOrFail($id);

        if ($project->thumbnail) {
            Storage::disk('public')->delete($project->thumbnail);
        }

        $project->forceDelete();

        return redirect()
            ->route('projects.trash')
            ->with('success', 'Project berhasil dihapus secara permanen.');
    }
}
