<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectGalleryController extends Controller
{
public function store(Request $request, Project $project)
{
    // Hitung jumlah gambar yang sudah tersimpan
    $currentImages = $project->images()->count();

    // Hitung sisa slot gambar
    $remainingSlots = 10 - $currentImages;

    // Jika gallery sudah mencapai 10 gambar
    if ($remainingSlots <= 0) {
        return back()->withErrors([
            'images' => 'Gallery sudah mencapai batas maksimal 10 gambar.'
        ]);
    }

    $validated = $request->validate([
        'images' => 'required|array|max:' . $remainingSlots,
        'images.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:4096|dimensions:min_width=800',
    ]);

    foreach ($request->file('images') as $index => $file) {
        $path = $file->store('projects/gallery', 'public');

        $project->images()->create([
            'image' => $path,
            'sort_order' => $currentImages + $index,
        ]);
    }

    return back()->with('success', 'Gambar gallery berhasil diunggah.');
}
    public function update(Request $request, Project $project, ProjectImage $image)
    {
        abort_if($image->project_id !== $project->id, 404);

        $validated = $request->validate([
            'caption' => 'nullable|string|max:255',
        ]);

        $image->update($validated);

        return back()->with('success', 'Caption gallery berhasil diperbarui.');
    }

    public function destroy(
        Project $project,
        ProjectImage $image
    ) {
        abort_if($image->project_id !== $project->id, 404);

        Storage::disk('public')->delete($image->image);

        $image->delete();

        return back()->with('success', 'Gambar gallery berhasil dihapus.');
    }
}
