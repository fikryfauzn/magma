<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $primaryKey = 'transaction_id';
    protected $fillable = [
        'user_id',
        'product_id',
        'total_amount',
        'quantity',
        'status',
        'shipping_address',
        'virtual_account_number',
        'transaction_type',
        'transaction_date',
        'reference_number'
    ];
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
