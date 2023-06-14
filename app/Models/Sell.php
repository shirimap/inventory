<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'total_amount',
        'invoice',
        'profit',
        'sales_date',
        'product_id'
      
    ];

    public function order(){
        return $this->belongsTo(Order::class);
       }
       public function product(){

        return $this->belongsTo(Product::class);
       }

}
