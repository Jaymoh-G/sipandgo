<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DashboardStatsWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        // Cache stats for 5 minutes
        $totalSales = Cache::remember('dashboard.total_sales', 300, function () {
            return Order::where('payment_status', 'paid')
                ->sum('total_amount');
        });

        $totalOrders = Cache::remember('dashboard.total_orders', 300, function () {
            return Order::count();
        });

        $lowStockCount = Cache::remember('dashboard.low_stock_count', 300, function () {
            return $this->getLowStockProductsCount();
        });

        return [
            Stat::make('Total Sales', 'Ksh ' . number_format($totalSales, 2))
                ->description('All time sales')
                ->descriptionIcon('heroicon-o-currency-dollar')
                ->color('success')
                ->chart($this->getSalesChartData()),

            Stat::make('Total Orders', number_format($totalOrders))
                ->description('All time orders')
                ->descriptionIcon('heroicon-o-shopping-bag')
                ->color('info'),

            Stat::make('Low Stock Products', number_format($lowStockCount))
                ->description('Products below threshold')
                ->descriptionIcon('heroicon-o-exclamation-triangle')
                ->color('warning')
                ->url(\App\Filament\Resources\Products\ProductResource::getUrl('index')),
        ];
    }

    /**
     * Get low stock products count
     */
    protected function getLowStockProductsCount(): int
    {
        // Products that track inventory and have low stock
        return DB::table('products')
            ->join('inventory', 'products.id', '=', 'inventory.product_id')
            ->where('products.track_inventory', true)
            ->where('products.is_active', true)
            ->whereNull('products.deleted_at')
            ->whereColumn('inventory.quantity_available', '<=', 'inventory.low_stock_threshold')
            ->count();
    }

    /**
     * Get sales chart data for the last 7 days
     */
    protected function getSalesChartData(): array
    {
        return Cache::remember('dashboard.sales_chart_data', 300, function () {
            $sales = Order::where('payment_status', 'paid')
                ->where('created_at', '>=', now()->subDays(7))
                ->selectRaw('DATE(created_at) as date, SUM(total_amount) as total')
                ->groupBy('date')
                ->orderBy('date')
                ->pluck('total', 'date')
                ->toArray();

            // Fill in missing days with 0
            $chartData = [];
            for ($i = 6; $i >= 0; $i--) {
                $date = now()->subDays($i)->format('Y-m-d');
                $chartData[] = $sales[$date] ?? 0;
            }

            return $chartData;
        });
    }
}

