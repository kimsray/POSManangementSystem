<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Expense;
use App\Models\Sales;
use Illuminate\Http\Request;
use PDF;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $dateAwal = date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')));
        $dateAkhir = date('Y-m-d');

        if ($request->has('date_awal') && $request->date_awal != "" && $request->has('date_akhir') && $request->date_akhir) {
            $dateAwal = $request->date_awal;
            $dateAkhir = $request->date_akhir;
        }

        return view('report.index', compact('dateAwal', 'dateAkhir'));
    }

    public function getData($awal, $akhir)
    {
        $no = 1;
        $data = array();
        $income = 0;
        $total_income = 0;

        while (strtotime($awal) <= strtotime($akhir)) {
            $date = $awal;
            $awal = date('Y-m-d', strtotime("+1 day", strtotime($awal)));

            $total_sales = Sales::where('created_at', 'LIKE', "%$date%")->sum('pay');
            $total_purchase = Purchase::where('created_at', 'LIKE', "%$date%")->sum('pay');
            $total_expense = Expense::where('created_at', 'LIKE', "%$date%")->sum('nominal');

            $income = $total_sales - $total_purchase - $total_expense;
            $total_income += $income;

            $row = array();
            $row['DT_RowIndex'] = $no++;
            $row['date'] = date_indonesia($date, false);
            $row['sales'] = format_uang($total_sales);
            $row['purchase'] = format_uang($total_purchase);
            $row['expense'] = format_uang($total_expense);
            $row['income'] = format_uang($income);

            $data[] = $row;
        }
        // visit "codeastro" for more projects!
        $data[] = [
            'DT_RowIndex' => '',
            'date' => '',
            'sales' => '',
            'purchase' => '',
            'expense' => 'Total Income',
            'income' => format_uang($total_income),
        ];

        return $data;
    }

    public function data($awal, $akhir)
    {
        $data = $this->getData($awal, $akhir);

        return datatables()
            ->of($data)
            ->make(true);
    }

    public function exportPDF($awal, $akhir)
    {
        $data = $this->getData($awal, $akhir);
        $pdf  = PDF::loadView('report.pdf', compact('awal', 'akhir', 'data'));
        $pdf->setPaper('a4', 'potrait');
        
        return $pdf->stream('report-income-'. date('Y-m-d-his') .'.pdf');
    }
}
