<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Branch;
use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $branch = Branch::where('name','=',$row['tawi'])->first();
        $category = Category::where('name','=',$row['kipengele'])->first();
        $net_amount = $row['bei'] - (($row['punguzo'] / 100)*$row['bei']);

        return new Product([

            'name'=>$row['jina'],
            'type'=>$row['aina'],
            'quantity'=>$row['idadi'],
            'amount'=>$row['bei'],
            'branch_id'=>$branch->id,
            'category_id'=>$category->id,
            'net_amount'=> $net_amount,
            'sub_quantity'=> $row['kupimwa'],
            'sub_amount'=> $row['bei1'],

        ]);
    }
}
