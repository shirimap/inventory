<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    use HasFactory;
    protected $fillable=['order','amount'];

    public function order(){
        return $this->belongsTo(Order::class);
       }
}
