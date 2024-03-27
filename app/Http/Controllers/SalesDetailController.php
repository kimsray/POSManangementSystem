<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Sales;
use App\Models\SalesDetail;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;

class SalesDetailController extends Controller
{
    public function index()
    {
        $product = Product::orderBy('name_product')->get();
        $member = Member::orderBy('name')->get();
        $discount = Setting::first()->discount ?? 0;

        // Check whether there are any transactions in progress
        if ($id_sales = session('id_sales')) {
            $sales = Sales::find($id_sales);
            $memberSelected = $sales->member ?? new Member();

            return view('sales_detail.index', compact('product', 'member', 'discount', 'id_sales', 'sales', 'memberSelected'));
        } else {
            if (auth()->user()->level == 1) {
                return redirect()->route('transaction.baru');
            } else {
                return redirect()->route('home');
            }
        }
    }

    public function data($id)
    {
        $detail = SalesDetail::with('product')
            ->where('id_sales', $id)
            ->get();

        $data = array();
        $total = 0;
        $total_item = 0;

        foreach ($detail as $item) {
            $row = array();
            $row['code_product'] = '<span class="label label-success">'. $item->product['code_product'] .'</span';
            $row['name_product'] = $item->product['name_product'];
            $row['price_sell']  = '$ '. format_uang($item->price_sell);
            $row['sum']      = '<input type="number" class="form-control input-sm quantity" data-id="'. $item->id_sales_detail .'" value="'. $item->sum .'">';
            $row['discount']      = $item->discount . '%';
            $row['subtotal']    = '$ '. format_uang($item->subtotal);
            $row['aksi']        = '<div class="btn-group">
                                    <button onclick="deleteData(`'. route('transaction.destroy', $item->id_sales_detail) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                                </div>';
            $data[] = $row;

            $total += $item->price_sell * $item->sum - (($item->discount * $item->sum) / 100 * $item->price_sell);;
            $total_item += $item->sum;
        }
        $data[] = [
            'code_product' => '
                <div class="total hide">'. $total .'</div>
                <div class="total_item hide">'. $total_item .'</div>',
            'name_product' => '',
            'price_sell'  => '',
            'sum'      => '',
            'discount'      => '',
            'subtotal'    => '',
            'aksi'        => '',
        ];

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->rawColumns(['aksi', 'code_product', 'sum'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $product = Product::where('id_product', $request->id_product)->first();
        if (! $product) {
            return response()->json('Data failed to save', 400);
        }

        $detail = new SalesDetail();
        $detail->id_sales = $request->id_sales;
        $detail->id_product = $product->id_product;
        $detail->price_sell = $product->price_sell;
        $detail->sum = 1;
        $detail->discount = $product->discount;
        $detail->subtotal = $product->price_sell - ($product->discount / 100 * $product->price_sell);;
        $detail->save();

        return response()->json('Data saved successfully', 200);
    }
    // visit "codeastro" for more projects!
    public function update(Request $request, $id)
    {
        $detail = SalesDetail::find($id);
        $detail->sum = $request->sum;
        $detail->subtotal = $detail->price_sell * $request->sum - (($detail->discount * $request->sum) / 100 * $detail->price_sell);;
        $detail->update();
    }

    public function destroy($id)
    {
        $detail = SalesDetail::find($id);
        $detail->delete();

        return response(null, 204);
    }

    public function loadForm($discount = 0, $total = 0, $accepted = 0)
    {
        $pay   = $total - ($discount / 100 * $total);
        $return = ($accepted != 0) ? $accepted - $pay : 0;
        $data    = [
            'totalrp' => format_uang($total),
            'pay' => $pay,
            'payrp' => format_uang($pay),
            'terbilang' => ucwords(terbilang($pay). ' Dollar'),
            'returnrp' => format_uang($return),
            'return_terbilang' => ucwords(terbilang($return). ' Dollar'),
        ];

        return response()->json($data);
    }
}
// visit "codeastro" for more projects!