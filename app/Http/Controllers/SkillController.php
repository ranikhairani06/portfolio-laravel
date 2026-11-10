<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SkillController extends Controller
{
    // Menampilkan form edit skill
    public function edit(string $id)
    {
        $skill = Skill::findOrFail($id);

        return view('skills.edit', compact('skill'));
    }

    // Memperbarui nama skill
    public function update(Request $request, string $id)
    {
        $skill = Skill::findOrFail($id);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('skills', 'name')->ignore($skill->id),
            ],
        ]);

        $skill->update($validated);

        return redirect()
            ->route('skills.edit', $skill->id)
            ->with('success', 'Skill berhasil diperbarui.');
    }
}
