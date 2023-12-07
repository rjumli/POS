<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use App\Models\ReceiveOrder;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;

class ReceivedController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'orderlist_id' => 'required',
            'status_id' => 'required',
            'quantity' => 'required_if:status_id,8',
            'price' => 'required_if:status_id,8',
        ]);

        $data = \DB::transaction(function () use ($request){
            $data = OrderList::with('product','status')->where('id',$request->orderlist_id)->first();
            $product_id = $data->product_id;
            $quantity = $data->quantity;
            if($request->status_id == 8){
                $received = ReceiveOrder::create($request->except('id'));
                if($received){
                    $product = Product::where('id',$product_id)->first();
                    $product->stock = $product->stock + $quantity;
                    $product->save();
                }
            }
            $data->status_id = $request->status_id;
            $data->save();
            
            $data =  Order::with('lists.product','lists.status','status','supplier.supplier')->where('id',$request->id)->first();
            $allStatusNotEqualSeven = $data->lists->every(function ($list) {
                return $list->status_id != 7;
            });
            if ($allStatusNotEqualSeven) {
                $data->update(['status_id' => 5]);
            }
            $data = Order::with('lists.product','lists.status','status','supplier.supplier')->where('id',$request->id)->first();
            return $data;
        });

        return back()->with([
            'message' => 'Order updated successfully. Thanks',
            'data' => new DefaultResource($data),
            'type' => 'bxs-check-circle',
            'color' => 'success'
        ]); 
    }
}
