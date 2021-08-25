<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function index()
    {
        $order = request('id') ?? Session::get('order');

        return view('payment', compact('order'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'order' => 'required|exists:products,id'
        ]);

        $id = request('order');

        $product = Product::owner()
            ->id($id)
            ->first();

        if (!$product->exists()) {
            return back()->with(
                'failed',
                'Can only be paid by the customer who created the order.'
            );
        }

        if (!$product->statusPayment() && $product->payment_status === Product::UNPAID && $product->status !== Product::CONFIRMED) {

            $message = $product->address
                ? 'Product transaction failed.'
                : 'Balance transaction failed.';

            return redirect()->route('order')
                ->with('failed', $message);

        } else {
            $product->update([
                'payment_status' => Product::PAID,
                'status' => Product::CONFIRMED
            ]);

            $message = $product->address
                ? 'Product is successfully paid.'
                : 'Balance is successfully paid.';

            return redirect()->route('order')
                ->with('status', $message);
        }
    }
}
