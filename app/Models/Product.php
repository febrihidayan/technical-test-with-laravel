<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'char';

    protected $perPage = 20;

    protected $fillable = [
        'user_id', 'title', 'address', 'price', 'total',
        'shipping_code', 'payment_status', 'status'
    ];

    public const CREATED = 'created';
    public const CONFIRMED = 'confirmed';
    public const CANCELLED = 'cancelled';
    public const FAILED = 'failed';

    public const PAID = 'paid';
    public const UNPAID = 'unpaid';

    public static function boot()
    {
        parent::boot();

        static::creating(function ($product) {

            $product->id = mt_rand(1000000000, 9999999999);

            $product->user_id = Auth::id();

            $product->payment_status = self::UNPAID;

            $product->status = self::CREATED;

        });

        Product::owner()
            ->where([
                ['created_at', '<=', now()->subMinutes(5)],
                ['payment_status', self::UNPAID]
            ])
            ->update([
                'status' => self::CANCELLED
            ]);
    }

    private function toRupiah($value)
    {
        return 'Rp' . number_format($value, 0, ',', '.');
    }

    public function price()
    {
        return $this->toRupiah($this->price);
    }

    public function total()
    {
        return $this->toRupiah($this->total);
    }

    public function statusPayment(): bool
    {
        return $this->created_at->addMinutes(5) >= now();
    }

    public function scopeId($query, $id)
    {
        return $query->where('id', $id);
    }

    public function scopeOwner($query)
    {
        return $query->where('user_id', Auth::id());
    }
}
