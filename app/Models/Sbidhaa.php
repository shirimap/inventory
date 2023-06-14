<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sbidhaa extends Model
{
    use HasFactory;
    protected $fillable=['name','type','threshold'];

    public function product()
    {
        return $this->hasMany(Product::class);
       }
}
