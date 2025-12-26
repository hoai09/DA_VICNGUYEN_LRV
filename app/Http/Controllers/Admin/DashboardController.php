<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\News;
use App\Models\Member;
use App\Models\ContactAdvice;
use App\Models\Portfolio_Contact;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
    
    }

    public function index(Request $request)
    {
        $period   = $request->get('period', 'today');
        $template = 'admin.dashboard.home.index';
        $config   = $this->getConfig();

        // Đếm số lượng
        $stats = $this->getStats();

        // Thống kê News
        $newsStats = $this->getNewsStats();

        // Thống kê thành viên
        $membersStats = $this->getMembersStats();

        // Thống kê form liên hệ
        $formStats = $this->getFormStats();

        // Thống kê biểu đồ
        $charts = [
            'projects' => $this->chartByPeriod(Project::class, $period),
            'members'  => $this->chartByPeriod(Member::class, $period),
            'news'     => $this->chartByPeriod(News::class, $period),
            'forms'    => $this->mergeChartSets(
                $this->chartByPeriod(ContactAdvice::class, $period),
                $this->chartByPeriod(Portfolio_Contact::class, $period)
            ),
        ];
        $projectChart = $charts['projects'];
        $latest = $this->getLatestEntities();

        return view('admin.dashboard.layout', compact(
            'template',
            'config',
            'stats',
            'charts',
            'latest',
            'period',
            'projectChart',
            'newsStats',
            'formStats',
            'membersStats'
        ));
    }

    private function getConfig()
    {
        return [
            'js' => [
                asset('js/plugins/flot/jquery.flot.js'),
                asset('js/plugins/flot/jquery.flot.tooltip.min.js'),
                asset('js/plugins/flot/jquery.flot.spline.js'),
                asset('js/plugins/flot/jquery.flot.resize.js'),
                asset('js/plugins/flot/jquery.flot.pie.js'),
                asset('js/plugins/flot/jquery.flot.symbol.js'),
                asset('js/plugins/flot/jquery.flot.time.js'),
                asset('js/plugins/peity/jquery.peity.min.js'),
                asset('js/demo/peity-demo.js'),
                asset('js/plugins/pace/pace.min.js'),
                asset('js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js'),
                asset('js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'),
                asset('js/plugins/easypiechart/jquery.easypiechart.js'),
                asset('js/plugins/sparkline/jquery.sparkline.min.js'),
                asset('js/demo/sparkline-demo.js')
            ]
        ];
    }

    private function getStats()
    {
        return [
            'projects' => Project::count(),
            'members'  => Member::count(),
            'news'     => News::count(),
            'contacts' => ContactAdvice::count() + Portfolio_Contact::count(),
        ];
    }

    
    //tin tức
    
    private function getNewsStats()
    {
        return [
            'total'   => News::count(),
            'today'   => News::whereDate('created_at', today())->count(),
            'month'   => News::whereYear('created_at', now()->year)
                            ->whereMonth('created_at', now()->month)
                            ->count(),
            'pending' => News::where('is_published', 0)->count(),
            'latest'  => News::latest()->limit(5)->get(),
        ];
    }

    
    //thành viên
    
    private function getMembersStats()
    {
        return [
            'total'   => Member::count(),
            'today'   => Member::whereDate('created_at', today())->count(),
            'month'   => Member::whereYear('created_at', now()->year)
                            ->whereMonth('created_at', now()->month)
                            ->count(),
            'latest'  => Member::latest()->limit(5)->get(),
        ];
    }

    
    //form liên hệ
    
    private function getFormStats()
    {
        $contactForms = ContactAdvice::select('id', 'full_name as fname', 'email', 'created_at')
            ->latest()
            ->limit(5)
            ->get()
            ->map(function ($item) {
                $item->type = 'Contact';
                return $item;
            });

        $portfolioForms = Portfolio_Contact::select('id', 'name as fname', 'email', 'created_at')
            ->latest()
            ->limit(5)
            ->get()
            ->map(function ($item) {
                $item->type = 'Portfolio';
                return $item;
            });

        return [
            'total' =>
                ContactAdvice::count()
                + Portfolio_Contact::count(),

            'today' =>
                ContactAdvice::whereDate('created_at', today())->count()
                + Portfolio_Contact::whereDate('created_at', today())->count(),

            'pending' =>
                ContactAdvice::where('status', 0)->count()
                + Portfolio_Contact::where('status', 0)->count(),

            'latest' => $contactForms
                ->merge($portfolioForms)
                ->sortByDesc('created_at')
                ->take(5)
                ->values()
        ];
    }

    
    //Lấy bản ghi mới nhất cho giao diện dashboard
    
    private function getLatestEntities()
    {
        return [
            'projects' => Project::latest()->limit(5)->get(),
            'contacts' => ContactAdvice::latest()->limit(5)->get(),
            'members'  => Member::latest()->limit(5)->get(),
            'news'     => News::latest()->limit(5)->get(),
        ];
    }

    
    private function chartByPeriod(string $model, string $type = 'monthly'): array
    {
        $labels = [];
        $data   = [];

        if ($type === 'today') {
            // 7 ngày gần nhất
            for ($i = 6; $i >= 0; $i--) {
                $date      = Carbon::now()->subDays($i);
                $labels[]  = $date->format('Y-m-d');
                $data[]    = $model::whereDate('created_at', $date)->count();
            }
        } elseif ($type === 'monthly') {
            // 12 tháng trong năm 
            for ($m = 1; $m <= 12; $m++) {
                $labels[] = now()->year . '-' . sprintf('%02d', $m) . '-01';
                $data[] = $model::whereYear('created_at', now()->year)
                                ->whereMonth('created_at', $m)
                                ->count();
            }
        } elseif ($type === 'annual') {
            // 5 năm gần nhất
            for ($y = now()->year - 4; $y <= now()->year; $y++) {
                $labels[] = $y . '-01-01';
                $data[]   = $model::whereYear('created_at', $y)->count();
            }
        }

        return compact('labels', 'data');
    }

    
    private function mergeChartSets(array $a, array $b): array
    {
        $data = collect($a['data'])->map(
            fn($v, $i) => $v + ($b['data'][$i] ?? 0)
        )->toArray();

        return [
            'labels' => $a['labels'],
            'data'   => $data,
            'total'  => array_sum($data),
        ];
    }

    private function monthlyChart(string $model, int $year): array
    {
        $raw = $model::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', $year)
            ->groupByRaw('MONTH(created_at)')
            ->pluck('total', 'month')
            ->toArray();

        return collect(range(1, 12))
            ->map(fn ($m) => $raw[$m] ?? 0)
            ->values()
            ->toArray();
    }

    private function dailyChart(string $model, int $days = 30): array
    {
        $labels = [];
        $data   = [];

        for ($i = $days - 1; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $labels[] = $date->format('Y-m-d');
            $data[]   = $model::whereDate('created_at', $date)->count();
        }

        return [
            'labels' => $labels,
            'data'   => $data,
            'total'  => array_sum($data),
        ];
    }
}