<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Product;
use App\Models\Supplier;

class PurchaseController extends Controller
{
    public function index()
    {
        $supplier = Supplier::orderBy('name')->get();

        return view('purchase.index', compact('supplier'));
    }
    // visit "codeastro" for more projects!
    public function data()
    {
        $purchase = Purchase::orderBy('id_purchase', 'desc')->get();

        return datatables()
            ->of($purchase)
            ->addIndexColumn()
            ->addColumn('total_item', function ($purchase) {
                return format_uang($purchase->total_item);
            })
            ->addColumn('total_price', function ($purchase) {
                return '$ '. format_uang($purchase->total_price);
            })
            ->addColumn('pay', function ($purchase) {
                return '$ '. format_uang($purchase->pay);
            })
            ->addColumn('date', function ($purchase) {
                return date_indonesia($purchase->created_at, false);
            })
            ->addColumn('supplier', function ($purchase) {
                return $purchase->supplier->name;
            })
            ->editColumn('discount', function ($purchase) {
                return $purchase->discount . '%';
            })
            ->addColumn('aksi', function ($purchase) {
                return '
                <div class="btn-group">
                    <button onclick="showDetail(`'. route('purchase.show', $purchase->id_purchase) .'`)" class="btn btn-xs btn-primary btn-flat"><i class="fa fa-eye"></i></button>
                    <button onclick="deleteData(`'. route('purchase.destroy', $purchase->id_purchase) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create($id)
    {
        $purchase = new Purchase();
        $purchase->id_supplier = $id;
        $purchase->total_item  = 0;
        $purchase->total_price = 0;
        $purchase->discount      = 0;
        $purchase->pay       = 0;
        $purchase->save();

        session(['id_purchase' => $purchase->id_purchase]);
        session(['id_supplier' => $purchase->id_supplier]);

        return redirect()->route('purchase_detail.index');
    }

    public function store(Request $request)
    {
        $purchase = Purchase::findOrFail($request->id_purchase);
        $purchase->total_item = $request->total_item;
        $purchase->total_price = $request->total;
        $purchase->discount = $request->discount;
        $purchase->pay = $request->pay;
        $purchase->update();

        $detail = PurchaseDetail::where('id_purchase', $purchase->id_purchase)->get();
        foreach ($detail as $item) {
            $product = Product::find($item->id_product);
            $product->stock += $item->sum;
            $product->update();
        }

        return redirect()->route('purchase.index');
    }

    public function show($id)
    {
        $detail = PurchaseDetail::with('product')->where('id_purchase', $id)->get();

        return datatables()
            ->of($detail)
            ->addIndexColumn()
            ->addColumn('code_product', function ($detail) {
                return '<span class="label label-success">'. $detail->product->code_product .'</span>';
            })
            ->addColumn('name_product', function ($detail) {
                return $detail->product->name_product;
            })
            ->addColumn('price_purchase', function ($detail) {
                return '$ '. format_uang($detail->price_purchase);
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

    public function destroy($id)
    {
        $purchase = Purchase::find($id);
        $detail    = PurchaseDetail::where('id_purchase', $purchase->id_purchase)->get();
        foreach ($detail as $item) {
            $product = Product::find($item->id_product);
            if ($product) {
                $product->stock -= $item->sum;
                $product->update();
            }
            $item->delete();
        }

        $purchase->delete();

        return response(null, 204);
    }
}
