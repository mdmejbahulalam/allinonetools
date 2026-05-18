<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tool;
use App\Models\Category;
use App\Models\ToolView;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $stats = [
            'total_tools' => Tool::count(),
            'total_categories' => Category::count(),
            'total_views' => ToolView::count(),
            'active_tools' => Tool::where('status', 'active')->count(),
        ];

        $topTools = Tool::orderBy('views', 'desc')->limit(10)->get();
        $recentTools = Tool::latest()->limit(5)->get();

        return view('admin.dashboard', compact('stats', 'topTools', 'recentTools'));
    }
}
