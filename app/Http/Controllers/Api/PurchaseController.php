<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $purchases = Purchase::get();
        return response()->json($purchases, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $purchase = new Purchase();
        $purchase->title = $request->title;
        $purchase->description = $request->description;
        $purchase->stock = $request->stock;
        $purchase->price = $request->price;
        $purchase->image = $request->image;
        $purchase->userId = $request->userId;
        $purchase->categoryId = $request->categoryId;

        $purchase->save();
        return response()->json($purchase, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        return response()->json([
            'title' => $purchase->title,
            'description' => $purchase->description,
            'stock' => $purchase->stock,
            'price' => $purchase->price,
            'image' => $purchase->image,
            'created_at' => $purchase->date,
            'userId' => $purchase->userId,
            'categoryId' => $purchase->categoryId
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $purchase = Purchase::findOrFail($request->id);
        $purchase->title = $request->title;
        $purchase->description = $request->description;
        $purchase->stock = $request->stock;
        $purchase->price = $request->price;
        $purchase->image = $request->image;
        $purchase->userId = $request->userId;
        $purchase->categoryId = $request->categoryId;

        $purchase->save();
        return response()->json($purchase, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        /* $purchase = purchase::destroy($request->id); */
        /* $purchase = purchase::findOrFail($request->id); */
        $purchase->delete();
        return response()->json('null', 204);
    }
}
