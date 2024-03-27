<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use App\Models\SalesDetail;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;
use PDF;

class SalesController extends Controller
{
    public function index()
    {
        return view('sales.index');
    }

    public function data()
    {
        $sales = Sales::with('member')->orderBy('id_sales', 'desc')->get();

        return datatables()
            ->of($sales)
            ->addIndexColumn()
            ->addColumn('total_item', function ($sales) {
                return format_uang($sales->total_item);
            })
            ->addColumn('total_price', function ($sales) {
                return '$ '. format_uang($sales->total_price);
            })
            ->addColumn('pay', function ($sales) {
                return '$ '. format_uang($sales->pay);
            })
            ->addColumn('date', function ($sales) {
                return date_indonesia($sales->created_at, false);
            })
            ->addColumn('code_member', function ($sales) {
                $member = $sales->member->code_member ?? '';
                return '<span class="label label-success">'. $member .'</spa>';
            })
            ->editColumn('discount', function ($sales) {
                return $sales->discount . '%';
            })
            ->editColumn('cashier', function ($sales) {
                return $sales->user->name ?? '';
            })
            ->addColumn('aksi', function ($sales) {
                return '
                <div class="btn-group">
                    <button onclick="showDetail(`'. route('sales.show', $sales->id_sales) .'`)" class="btn btn-xs btn-primary btn-flat"><i class="fa fa-eye"></i></button>
                    <button onclick="deleteData(`'. route('sales.destroy', $sales->id_sales) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi', 'code_member'])
            ->make(true);
    }
    // visit "codeastro" for more projects!
    public function create()
    {
        $sales = new Sales();
        $sales->id_member = null;
        $sales->total_item = 0;
        $sales->total_price = 0;
        $sales->discount = 0;
        $sales->pay = 0;
        $sales->accepted = 0;
        $sales->id_user = auth()->id();
        $sales->save();

        session(['id_sales' => $sales->id_sales]);
        return redirect()->route('transaction.index');
    }

    public function store(Request $request)
    {
        $sales = Sales::findOrFail($request->id_sales);
        $sales->id_member = $request->id_member;
        $sales->total_item = $request->total_item;
        $sales->total_price = $request->total;
        $sales->discount = $request->discount;
        $sales->pay = $request->pay;
        $sales->accepted = $request->accepted;
        $sales->update();

        $detail = SalesDetail::where('id_sales', $sales->id_sales)->get();
        foreach ($detail as $item) {
            $item->discount = $request->discount;
            $item->update();

            $product = Product::find($item->id_product);
            $product->stock -= $item->sum;
            $product->update();
        }

        return redirect()->route('transaction.finish');
    }

    public function show($id)
    {
        $detail = SalesDetail::with('product')->where('id_sales', $id)->get();

        return datatables()
            ->of($detail)
            ->addIndexColumn()
            ->addColumn('code_product', function ($detail) {
                return '<span class="label label-success">'. $detail->product->code_product .'</span>';
            })
            ->addColumn('name_product', function ($detail) {
                return $detail->product->name_product;
            })
            ->addColumn('price_sell', function ($detail) {
                return '$ '. format_uang($detail->price_sell);
            })
            ->addColumn('sum', function ($detail) {
                return format_uang($detail->sum);
            })
            ->addColumn('subtotal', function ($detail) {
                return '$ '. format_uang($detail->subtotal);
            })
            ->rawColumns(['code_product'])
            ->make(true);
    }
    // visit "codeastro" for more projects!
    public function destroy($id)
    {
        $sales = Sales::find($id);
        $detail    = SalesDetail::where('id_sales', $sales->id_sales)->get();
        foreach ($detail as $item) {
            $product = Product::find($item->id_product);
            if ($product) {
                $product->stock += $item->sum;
                $product->update();
            }

            $item->delete();
        }

        $sales->delete();

        return response(null, 204);
    }

    public function finish()
    {
        $setting = Setting::first();

        return view('sales.finish', compact('setting'));
    }

    public function notaKecil()
    {
        $setting = Setting::first();
        $sales = Sales::find(session('id_sales'));
        if (! $sales) {
            abort(404);
        }
        $detail = SalesDetail::with('product')
            ->where('id_sales', session('id_sales'))
            ->get();
        
        return view('sales.note_small', compact('setting', 'sales', 'detail'));
    }

    public function notaBesar()
    {
        $setting = Setting::first();
        $sales = Sales::find(session('id_sales'));
        if (! $sales) {
            abort(404);
        }
        $detail = SalesDetail::with('product')
            ->where('id_sales', session('id_sales'))
            ->get();

        $pdf = PDF::loadView('sales.nota_besar', compact('setting', 'sales', 'detail'));
        $pdf->setPaper(0,0,609,440, 'potrait');
        return $pdf->stream('Transaction-'. date('Y-m-d-his') .'.pdf');
    }
}
// visit "codeastro" for more projects!