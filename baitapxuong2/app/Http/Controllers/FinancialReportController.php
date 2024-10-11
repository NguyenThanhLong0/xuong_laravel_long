<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinancialReportController extends Controller
{
    // Hàm này đùng để tính tổng doanh thu theo tháng
    public function tongDoanhThuThang()
    {
        $sales = DB::table('sales')
            ->select(DB::raw('SUM(total) as total_sales, MONTH(sale_date) as month, YEAR(sale_date) as year'))
            ->groupBy(DB::raw('MONTH(sale_date), YEAR(sale_date)'))
            ->get();

        return $sales;
    }

    // Hàm này tính tổng chi phí theo tháng
    public function tongChiPhiThang()
    {
        $expenses = DB::table('expenses')
            ->select(DB::raw('SUM(amount) as total_expenses, MONTH(expense_date) as month, YEAR(expense_date)'))
            ->groupBy(DB::raw('MONTH(expense_date), YEAR(expense_date)'))
            ->get();

        return $expenses;
    }

    // Tạo báo cáo tài chính cho một tháng
    // public function createMonthlyFinancialReport($month, $year)
    // {

    //     $total_sales = DB::table('sales')
    //         ->whereMonth('sale_date', $month)
    //         ->whereYear('sale_date', $year)
    //         ->sum('total');

    //     $total_expenses = DB::table('expenses')
    //         ->whereMonth('expense_date', $month)
    //         ->whereYear('expense_date', $year)
    //         ->sum('amount');

    //     $tax_rate = DB::table('taxes')->where('tax_name', 'VAT')->value('rate');

    //     $profit_before_tax = $total_sales - $total_expenses;
    //     $tax_amount = $total_sales * ($tax_rate / 100);
    //     $profit_after_tax = $profit_before_tax - $tax_amount;

    //     DB::table('financial_reports')->insert([
    //         'month' => $month,
    //         'year' => $year,
    //         'total_sales' => $total_sales,
    //         'total_expenses' => $total_expenses,
    //         'profit_before_tax' => $profit_before_tax,
    //         'tax_amount' => $tax_amount,
    //         'profit_after_tax' => $profit_after_tax,
    //         'created_at' => now(),
    //         'updated_at' => now(),
    //     ]);

    //     return "Báo cáo tài chính cho tháng $month năm $year";
    // }



    public function baoCaoTaiChinh($month, $year)
    {
        // Tính tổng doanh thu trong tháng và năm
        $total_sales = DB::table('sales')
            ->whereMonth('sale_date', $month)
            ->whereYear('sale_date', $year)
            ->sum('total');


        $total_expenses = DB::table('expenses')
            ->whereMonth('expense_date', $month)
            ->whereYear('expense_date', $year)
            ->sum('amount');


        $tax_rate = DB::table('taxes')->where('tax_name', 'VAT')->value('rate');


        $profit_before_tax = $total_sales - $total_expenses;
        $tax_amount = $total_sales * ($tax_rate / 100);
        $profit_after_tax = $profit_before_tax - $tax_amount;


        DB::table('financial_reports')->insert([
            'month' => $month,
            'year' => $year,
            'total_sales' => $total_sales,
            'total_expenses' => $total_expenses,
            'profit_before_tax' => $profit_before_tax,
            'tax_amount' => $tax_amount,
            'profit_after_tax' => $profit_after_tax,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return "
        Báo cáo tài chính cho tháng $month năm $year:<br>
        - Tổng doanh thu: $total_sales VND<br>
        - Tổng chi phí: $total_expenses VND<br>
        - Lợi nhuận trước thuế: $profit_before_tax VND<br>
        - Thuế (VAT $tax_rate%): $tax_amount VND<br>
        - Lợi nhuận sau thuế: $profit_after_tax VND
    ";
    }
}
