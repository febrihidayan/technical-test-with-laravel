<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductPageController extends Controller
{
    protected function index()
    {
        return view('product');
    }

    protected function store(Request $request)
    {
        $request->validate([
            'product' => 'required|min:10|max:150',
            'address' => 'required|min:10|max:150',
            'price' => 'required'
        ]);

        $code = strtoupper(substr(md5(uniqid(request('product'), true)), 0, 8));

        $product = Product::create([
            'title' => request('product'),
            'address' => request('address'),
            'shipping_code' => $code,
            'price' => request('price'),
            'total' => (double) request('price') + 10000
        ]);

        Session::put('order', $product->id);

        return redirect()->route('success');
    }
}
