<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'location',
        'address',
        'email',
        'phoneNumber',
        'created_date',
        'updated_date',
    ];


    public function product(){


     return $this->hasMany(Product::class);
    }

    public function user(){


        return $this->hasMany(User::class);
       }

}
