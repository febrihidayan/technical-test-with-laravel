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
            $payment = Product::PAID;
            $status = Product::CONFIRMED;

            $message = $product->address
                ? 'Product is successfully paid.'
                : 'Balance is successfully paid.';
            
            if (!$product->address) {
                $time = now()->format('H');
                $rate = $time >= '09' && $time <= '17' ? 90 : 40;

                $rageProduct = Product::whereDate('created_at', now()->today())
                    ->whereNull('address')
                    ->where( function($query) {
                        return $query
                            ->where('status', Product::CONFIRMED)
                            ->orWhere('status', Product::FAILED);
                    })
                    ->get('status');
                
                $confirmed = collect($rageProduct)
                    ->where('status', Product::CONFIRMED)
                    ->count();

                $percentage = 100 - ((1 - $confirmed / ($rageProduct->count() ?: 1)) * 100);

                if ($percentage >= $rate) {
                    $payment = Product::UNPAID;
                    $status = Product::FAILED;
                    $message = 'Balance transaction failed.';
                }
            }

            $product->update([
                'payment_status' => $payment,
                'status' => $status
            ]);

            return redirect()->route('order')
                ->with(
                    $status == Product::CONFIRMED ? 'status' : 'failed',
                    $message
                );
        }
    }
}
