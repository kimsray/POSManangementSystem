<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseDetailController extends Controller
{
    public function index()
    {
        $id_purchase = session('id_purchase');
        $product = Product::orderBy('name_product')->get();
        $supplier = Supplier::find(session('id_supplier'));
        $discount = Purchase::find($id_purchase)->discount ?? 0;

        if (! $supplier) {
            abort(404);
        }

        return view('purchase_detail.index', compact('id_purchase', 'product', 'supplier', 'discount'));
    }

    public function data($id)
    {
        $detail = PurchaseDetail::with('product')
            ->where('id_purchase', $id)
            ->get();
        $data = array();
        $total = 0;
        $total_item = 0;

        foreach ($detail as $item) {
            $row = array();
            $row['code_product'] = '<span class="label label-success">'. $item->product['code_product'] .'</span';
            $row['name_product'] = $item->product['name_product'];
            $row['price_purchase']  = '$ '. format_uang($item->price_purchase);
            $row['sum']      = '<input type="number" class="form-control input-sm quantity" data-id="'. $item->id_purchase_detail .'" value="'. $item->sum .'">';
            $row['subtotal']    = '$ '. format_uang($item->subtotal);
            $row['aksi']        = '<div class="btn-group">
                                    <button onclick="deleteData(`'. route('purchase_detail.destroy', $item->id_purchase_detail) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                                </div>';
            $data[] = $row;

            $total += $item->price_purchase * $item->sum;
            $total_item += $item->sum;
        }
        $data[] = [
            'code_product' => '
                <div class="total hide">'. $total .'</div>
                <div class="total_item hide">'. $total_item .'</div>',
            'name_product' => '',
            'price_purchase'  => '',
            'sum'      => '',
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

        $detail = new PurchaseDetail();
        $detail->id_purchase = $request->id_purchase;
        $detail->id_product = $product->id_product;
        $detail->price_purchase = $product->price_purchase;
        $detail->sum = 1;
        $detail->subtotal = $product->price_purchase;
        $detail->save();

        return response()->json('Data saved successfully', 200);
    }
    // visit "codeastro" for more projects!
    public function update(Request $request, $id)
    {
        $detail = PurchaseDetail::find($id);
        $detail->sum = $request->sum;
        $detail->subtotal = $detail->price_purchase * $request->sum;
        $detail->update();
    }

    public function destroy($id)
    {
        $detail = PurchaseDetail::find($id);
        $detail->delete();

        return response(null, 204);
    }

    public function loadForm($discount, $total)
    {
        $pay = $total - ($discount / 100 * $total);
        $data  = [
            'totalrp' => format_uang($total),
            'pay' => $pay,
            'payrp' => format_uang($pay),
            'terbilang' => ucwords(terbilang($pay). ' Dollar')
        ];

        return response()->json($data);
    }
}
