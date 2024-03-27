<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Member;
use App\Models\Purchase;
use App\Models\Expense;
use App\Models\Sales;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $category = Category::count();
        $product = Product::count();
        $supplier = Supplier::count();
        $member = Member::count();
        $sales = Sales::sum('accepted');
        $expense = Expense::sum('nominal');
        $purchase = Purchase::sum('pay');

        $date_awal = date('Y-m-01');
        $date_akhir = date('Y-m-d');

        $data_date = array();
        $data_income = array();

        while (strtotime($date_awal) <= strtotime($date_akhir)) {
            $data_date[] = (int) substr($date_awal, 8, 2);

            $total_sales = Sales::where('created_at', 'LIKE', "%$date_awal%")->sum('pay');
            $total_purchase = Purchase::where('created_at', 'LIKE', "%$date_awal%")->sum('pay');
            $total_expense = Expense::where('created_at', 'LIKE', "%$date_awal%")->sum('nominal');

            $income = $total_sales - $total_purchase - $total_expense;
            $data_income[] = $income;

            $date_awal = date('Y-m-d', strtotime("+1 day", strtotime($date_awal)));
        }

        $date_awal = date('Y-m-01');

        if (auth()->user()->level == 1) {
            return view('admin.dashboard', compact('category', 'product', 'supplier', 'member', 'sales', 'expense', 'purchase', 'date_awal', 'date_akhir', 'data_date', 'data_income'));
        } else {
            return view('cashier.dashboard');
        }
        
    }
}
