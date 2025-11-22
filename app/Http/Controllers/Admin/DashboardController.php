<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\News;
use App\Models\ProjectInformation;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->input('year', date('Y'));
        $statusFilter = $request->input('project_status', 'all');
        $newsFilter = $request->input('news_type', 'all');

        // ===== DỰ ÁN =====
        $projectQuery = Project::query();
        if($statusFilter != 'all') $projectQuery->where('status', $statusFilter);

        $projectCount = $projectQuery->count();
        $doingProjects = Project::where('status', 'Đang triển khai')->count();
        $doneProjects = Project::where('status', 'Hoàn thành')->count();
        $pausedProjects = Project::where('status', 'Tạm dừng')->count();
        $recentProjects = $projectQuery->latest()->take(5)->get();

        // ===== TIN TỨC =====
        $newsQuery = News::query();
        if($newsFilter == 'featured') $newsQuery->where('featured_news', true);

        $newsCount = $newsQuery->count();
        $recentNews = $newsQuery->latest()->take(5)->get();

        // ===== FỎM =====
        $formQuery = ProjectInformation::query();
        $formCount = $formQuery->count();
        $recentForms = $formQuery->latest()->take(5)->get();

        
        $months = range(1,12);

        $monthlyProjectsRaw = Project::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->when($statusFilter != 'all', fn($q)=>$q->where('status',$statusFilter))
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->pluck('total','month')
            ->toArray();
        $monthlyProjects = [];
        foreach($months as $m) $monthlyProjects[$m] = $monthlyProjectsRaw[$m] ?? 0;

        $monthlyNewsRaw = News::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->when($newsFilter == 'featured', fn($q)=>$q->where('featured_news', true))
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->pluck('total','month')
            ->toArray();
        $monthlyNews = [];
        foreach($months as $m) $monthlyNews[$m] = $monthlyNewsRaw[$m] ?? 0;

        $monthlyFormsRaw = ProjectInformation::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->pluck('total','month')
            ->toArray();
        $monthlyForms = [];
        foreach($months as $m) $monthlyForms[$m] = $monthlyFormsRaw[$m] ?? 0;

        return view('admin.dashboard', compact(
            'projectCount','doingProjects','doneProjects','pausedProjects','recentProjects',
            'newsCount','recentNews',
            'formCount','recentForms',
            'monthlyProjects','monthlyNews','monthlyForms',
            'year','statusFilter','newsFilter'
        ));
    }
}
