<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PrepaidBalanceController extends Controller
{
    protected function index()
    {
        return view('prepaid-balance');
    }

    protected function store(Request $request)
    {
        $request->validate([
            'number' => 'required|min:7|max:12',
            'value' => 'required|in:10000,50000,100000'
        ]);

        if (substr(request('number'), 0, 3) !== '081') {

            return back()
                ->withInput($request->all())
                ->with('failed', 'Must be prefixed with 081.');

        }

        $admin = ((double) request('value') / 100) * 5;
        $total = $admin + (double) request('value');

        $product = Product::create([
            'title' => request('number'),
            'price' => request('value'),
            'total' => $total
        ]);

        Session::put('order', $product->id);

        return redirect()->route('success');
    }
}
