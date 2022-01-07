<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        //
        return Inertia::render('Product/List');
    }

    public function showCart()
    {
        //
        return Inertia::render('Product/Cart');
    }

    public function cartProducts(Request $request) {
        //$user = $request->user();
        $user = User::find(1);
        return response()->json($user->attachedProducts()->with('creator')->get());
    }

    public function attach(Request $request, $id)
    {
        $product = Product::find($id);
        $product->attachedUsers()->attach(/*$request->user()*/ 1);

        return response()->json(['status' => "success"]);
    }

    public function list()
    {
        $products = Product::with('creator')->get();
        return response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        //
        return Inertia::render('Product/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        //
        try {
            $this->validate($request, [
                'name' => 'required',
                'price' => 'required|numeric',
                'description' => 'required'
            ]);

            $product = new Product($request->all());
            if ($request->has('image')) {
                $image = str_replace('data:image/png;base64,', '', $request->input('image'));
                $image = str_replace(' ', '+', $image);
                $fileName = "products/".Str::random().".png";
                Storage::disk('public')->put($fileName, base64_decode($image));
                $product->image = Storage::disk('public')->url($fileName);
            }
            $product->creator()->associate(/*$request->user()*/1);
            $product->save();

            return response()->json(['status' => "success"]);
        } catch (ValidationException $e) {
            return response()->json(['status' => "error"] + $e->errors());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
