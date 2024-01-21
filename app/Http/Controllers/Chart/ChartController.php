<?php

namespace App\Http\Controllers\Chart;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Quote;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function getSalesChartData(Request $request)
    {
        $type = $request->input('type'); // 'daily' or 'monthly'
        $data = [];

        if ($type === 'daily') {
            $dailyData = $this->getDailyData();
            $data['labels'] = $dailyData['labels'];
            $data['orders'] = $dailyData['orders'];
            $data['quotes'] = $dailyData['quotes'];
        } elseif ($type === 'monthly') {
            $monthlyData = $this->getMonthlyData();
            $data['labels'] = $monthlyData['labels'];
            $data['orders'] = $monthlyData['orders'];
            $data['quotes'] = $monthlyData['quotes'];
        }

        return response()->json($data);
    }

    private function getDailyData()
    {
        $currentDate = now();
        $startDate = $currentDate->copy()->subDays(6);

        $labels = [];
        $orders = [];
        $quotes = [];

        for ($day = 0; $day <= 6; $day++) {
            $date = $startDate->copy()->addDays($day);

            $labels[] = $date->format('M d');
            $orderCount = Order::whereDate('created_at', $date)->count();
            $orders[] = $orderCount;
            $quoteCount = Quote::whereDate('created_at', $date)->count();
            $quotes[] = $quoteCount;
        }

        return compact('labels', 'orders', 'quotes');
    }


    private function getMonthlyData()
    {
        $labels = [];
        $orders = [];
        $quotes = [];

        for ($i = 0; $i < 7; $i++) {
            $targetDate = now()->subMonths($i);

            $monthOrders = Order::whereMonth('created_at', $targetDate->month)
                ->whereYear('created_at', $targetDate->year)
                ->count();

            $monthQuotes = Quote::whereMonth('created_at', $targetDate->month)
                ->whereYear('created_at', $targetDate->year)
                ->count();

            $labels[] = $targetDate->format('M Y');
            $orders[] = $monthOrders;
            $quotes[] = $monthQuotes;
        }

        $labels = array_reverse($labels);
        $orders = array_reverse($orders);
        $quotes = array_reverse($quotes);

        return compact('labels', 'orders', 'quotes');
    }

    public function getOrderChartData()
    {
        $data = $this->getChartData();

        return response()->json($data);
    }

    private function getChartData()
    {
        $currentMonth = Carbon::now();
        $months = [];

        for ($i = 0; $i < 7; $i++) {
            $months[] = $currentMonth->format('M Y');
            $currentMonth->subMonth();
        }

        $orderTypes = Order::select('order_type')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('order_type')
            ->get();

        $datasets = [];

        foreach ($orderTypes as $orderType) {
            $orderTypeData = Order::selectRaw('COUNT(*) as count, DATE_FORMAT(created_at, "%b %Y") as month')
                ->where('order_type', $orderType->order_type)
                ->whereBetween('created_at', [now()->subMonths(6), now()])
                ->groupBy('month')
                ->orderBy('month')
                ->pluck('count', 'month')
                ->toArray();

            $data = [];
            foreach ($months as $month) {
                $data[] = $orderTypeData[$month] ?? 0;
            }

            $datasets[] = [
                'label' => $orderType->order_type,
                'data' => $data,
            ];
        }

        return [
            'labels' => $months,
            'datasets' => $datasets,
        ];
    }
}
