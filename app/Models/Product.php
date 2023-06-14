<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
               
        'quantity',
        'bprice',
        'pprofit',
        'capital',
        'amount',
        'net_amount',
        'sub_amount',
        'sub_quantity',
        'branch_id',
        'category_id',
        'sbidhaa_id',
        'created_at',
        'updated_at',
    ];


    public function branch(){
        return $this->belongsTo(Branch::class);
       }
    public function sbidhaa(){
        return $this->belongsTo(Sbidhaa::class);
       }
       


       public function category(){
        return $this->belongsTo(Category::class);
       }

       public function sell(){

        return $this->hasMany(Sell::class);
       }
}
