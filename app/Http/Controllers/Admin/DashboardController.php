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
    public function __construct(){
        
    }

    public function index(Request $request)
    {
        $period = $request->get('period', 'today');
    
        $config   = $this->config();
        $template = 'admin.dashboard.home.index';
    
        $stats = [
            'projects' => Project::count(),
            'members'  => Member::count(),
            'news'     => News::count(),
            'contacts' => ContactAdvice::count() + Portfolio_Contact::count(),
        ];

        $newsStats = [
            'total'   => News::count(),
            'today'   => News::whereDate('created_at', today())->count(),
            'month'   => News::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->count(),
            'pending' => News::where('is_published', 0)->count(),
        
            'latest'  => News::latest()
                ->limit(5)
                ->get(),
        ];

        $formStats = [
            'total' =>
                ContactAdvice::count()
                + Portfolio_Contact::count(),
    
            'today' =>
                ContactAdvice::whereDate('created_at', today())->count()
                + Portfolio_Contact::whereDate('created_at', today())->count(),

    
            'pending' =>
                ContactAdvice::where('status', 0)->count()
                + Portfolio_Contact::where('status', 0)->count(),
        ];

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

    $formStats['latest'] = $contactForms
        ->merge($portfolioForms)
        ->sortByDesc('created_at')
        ->take(5);
    
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

        $latest = [
            'projects' => Project::latest()->limit(5)->get(),
            'contacts' => ContactAdvice::latest()->limit(5)->get(),
            'members'  => Member::latest()->limit(5)->get(),
            'news'     => News::latest()->limit(5)->get(),
        ];
    
        return view(
            'admin.dashboard.layout',
            compact(
                'template',
                'config',
                'stats',
                'charts',
                'latest',
                'period',
                'projectChart',
                'newsStats',
                'formStats'
            )
        );
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
                    asset('js/plugins/pace/pace.min.js'),
                    asset('js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js'),
                    asset('js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'),
                    asset('js/plugins/easypiechart/jquery.easypiechart.js'),
                    asset('js/plugins/sparkline/jquery.sparkline.min.js'),
                    asset('js/demo/sparkline-demo.js')
            ]
        ];
    }

private function monthlyChart(string $model, int $year)
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

    private function chartByPeriod(string $model, string $type = 'monthly'): array
    {
        $labels = [];
        $data   = [];
    
        if ($type === 'today') {
            for ($i = 6; $i >= 0; $i--) {
                $date = Carbon::now()->subDays($i);
                $labels[] = $date->format('Y-m-d');
                $data[] = $model::whereDate('created_at', $date)->count();
            }
        }
    
        if ($type === 'monthly') {
            for ($m = 1; $m <= 12; $m++) {
                $labels[] = now()->year . '-' . sprintf('%02d', $m) . '-01';
                $data[] = $model::whereYear('created_at', now()->year)
                                ->whereMonth('created_at', $m)
                                ->count();
            }
        }
    
        if ($type === 'annual') {
            for ($y = now()->year - 4; $y <= now()->year; $y++) {
                $labels[] = $y . '-01-01';
                $data[] = $model::whereYear('created_at', $y)->count();
            }
        }
    
        return compact('labels', 'data');
    }

    private function mergeChartSets(array $a, array $b): array
    {
        $data = collect($a['data'])->map(
            fn ($v, $i) => $v + ($b['data'][$i] ?? 0)
        )->toArray();
    
        return [
            'labels' => $a['labels'],
            'data'   => $data,
            'total'  => array_sum($data),
        ];
    }
    

}