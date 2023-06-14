<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_name',
        'product_id',
        'user_id',
        'quantity',
        'amount',
        'checkout_Amount',
        'net_amount',
        'discount',
        'created_date',
        'update_date',

    ];


       public function user(){


        return $this->belongsTo(User::class);
       }

       public function sells(){
        return $this->hasMany(Sell::class);
       }

       public function debt(){
        return $this->hasMany(Debt::class);
       }
}
