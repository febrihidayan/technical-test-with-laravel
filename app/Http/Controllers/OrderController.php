<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __invoke()
    {
        $q = request('search');

        $products = Product::when($q, function($query) use ($q) {
                return $query->where('id', 'like', "%$q%");
            })
            ->owner()
            ->latest()
            ->paginate();

        return view('orders', compact('products'));
    }
}
