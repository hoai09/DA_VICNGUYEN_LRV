<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\News;
use App\Models\ContactAdvice;

class DashboardController extends Controller
{
    public function __construct(){
        
    }
    public function index(){

        $config = $this->config();
        $template = 'admin.dashboard.home.index';
        return view('admin.dashboard.layout',compact('template','config'));
    }

    private function config() {
        return[
            'js'=>[ asset('js/plugins/flot/jquery.flot.js'),
                    asset('js/plugins/flot/jquery.flot.tooltip.min.js'),
                    asset('js/plugins/flot/jquery.flot.spline.js'),
                    asset('js/plugins/flot/jquery.flot.resize.js'),
                    asset('js/plugins/flot/jquery.flot.pie.js'),
                    asset('js/plugins/flot/jquery.flot.symbol.js'),
                    asset('js/plugins/flot/jquery.flot.time.js'),
                    asset('js/plugins/peity/jquery.peity.min.js'),
                    asset('js/demo/peity-demo.js'),
                    // asset('js/inspinia.js'),
                    asset('js/plugins/pace/pace.min.js'),
                    asset('js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js'),
                    asset('js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'),
                    asset('js/plugins/easypiechart/jquery.easypiechart.js'),
                    asset('js/plugins/sparkline/jquery.sparkline.min.js'),
                    asset('js/demo/sparkline-demo.js')
            ]
        ];
    }


    // public function index(Request $request)
    // {
    //     $year = $request->input('year', date('Y'));
    //     $statusFilter = $request->input('project_status', 'all');
    //     $newsFilter = $request->input('news_type', 'all');

    //     // ===== DỰ ÁN =====
    //     $projectQuery = Project::query();
    //     if($statusFilter != 'all') $projectQuery->where('status', $statusFilter);

    //     $projectCount = $projectQuery->count();
    //     $doingProjects = Project::where('status', 'Đang triển khai')->count();
    //     $doneProjects = Project::where('status', 'Hoàn thành')->count();
    //     $pausedProjects = Project::where('status', 'Tạm dừng')->count();
    //     $recentProjects = $projectQuery->latest()->take(5)->get();

    //     // ===== TIN TỨC =====
    //     $newsQuery = News::query();
    //     if($newsFilter == 'featured') $newsQuery->where('featured_news', true);

    //     $newsCount = $newsQuery->count();
    //     $recentNews = $newsQuery->latest()->take(5)->get();

    //     // ===== FỎM =====
    //     $formQuery = ContactAdvice::query();
    //     $formCount = $formQuery->count();
    //     $recentForms = $formQuery->latest()->take(5)->get();

        
    //     $months = range(1,12);

    //     $monthlyProjectsRaw = Project::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
    //         ->when($statusFilter != 'all', fn($q)=>$q->where('status',$statusFilter))
    //         ->whereYear('created_at', $year)
    //         ->groupBy('month')
    //         ->pluck('total','month')
    //         ->toArray();
    //     $monthlyProjects = [];
    //     foreach($months as $m) $monthlyProjects[$m] = $monthlyProjectsRaw[$m] ?? 0;

    //     $monthlyNewsRaw = News::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
    //         ->when($newsFilter == 'featured', fn($q)=>$q->where('featured_news', true))
    //         ->whereYear('created_at', $year)
    //         ->groupBy('month')
    //         ->pluck('total','month')
    //         ->toArray();
    //     $monthlyNews = [];
    //     foreach($months as $m) $monthlyNews[$m] = $monthlyNewsRaw[$m] ?? 0;

    //     $monthlyFormsRaw = ContactAdvice::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
    //         ->whereYear('created_at', $year)
    //         ->groupBy('month')
    //         ->pluck('total','month')
    //         ->toArray();
    //     $monthlyForms = [];
    //     foreach($months as $m) $monthlyForms[$m] = $monthlyFormsRaw[$m] ?? 0;

    //     return view('admin.dashboard', compact(
    //         'projectCount','doingProjects','doneProjects','pausedProjects','recentProjects',
    //         'newsCount','recentNews',
    //         'formCount','recentForms',
    //         'monthlyProjects','monthlyNews','monthlyForms',
    //         'year','statusFilter','newsFilter'
    //     ));
    // }
}
