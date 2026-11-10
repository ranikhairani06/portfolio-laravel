<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Category;
use App\Models\Skill;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // Menghitung total project
        $totalProjects = Project::count();

        // Menghitung project berdasarkan status
        $publishedProjects = Project::where('status', 'published')->count();
        $draftProjects = Project::where('status', 'draft')->count();

        // Menghitung jumlah project pada setiap kategori
        $categories = Category::withCount('projects')->get();

        $totalCategories = Category::count();
        $totalSkills = Skill::count();

        // Mengambil 5 skill yang paling banyak digunakan
        $topSkills = Skill::withCount('projects')
            ->orderByDesc('projects_count')
            ->take(5)
            ->get();

        // Mengambil 5 project terbaru beserta kategorinya
        $latestProjects = Project::with('category')
            ->latest()
            ->take(5)
            ->get();

        return view('post.dashboard.index', compact(
            'totalProjects',
            'totalCategories',
            'totalSkills',
            'publishedProjects',
            'draftProjects',
            'categories',
            'topSkills',
            'latestProjects'
        ));
    }
}
