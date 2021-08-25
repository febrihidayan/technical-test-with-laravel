<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SuccessController extends Controller
{
    public function __invoke()
    {
        $product = Product::find(Session::get('order'));

        return view('success', compact('product'));
    }
}
