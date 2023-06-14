<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\Matumizi;
use App\Models\Branch;
use App\Models\Sales;
use App\Models\Stock;
use App\Models\Sbidhaa;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
class ApiController extends Controller
{

     //---------------------PRODUCT CRUD----------------------------------------------------------------
    public function createProduct(Request $request){

        $validate = Validator::make($request->all(),[
            'name'=>'required',
            'image'=>'required|image|mimes:png,jpg|max:2048',
            'price'=>'required',
        ]);

         if ($validate->fails()){
            return response()->json($validate->errors(),422);
         }

        $image = $request->file('image');
        $image->storeAs('public/product',$image->hashName());

        $product = Product::create([
            'name'=> $request->name,
            'image'=>$image->hashName(),
            'price'=>$request->price,
        ]);

        return response()->json($product);
    }


    public function showProducts(){

        $product = Product::all();

        return response()->json($product);
    }

    public function getProduct($id){

        $product = Product::find($id);

        if ($product)
        {
            return response()->json($product);

        }
        return response()->json([
            "message"=>"user not found"
        ]
    );

    }

    public function editProduct(Request $request,$id){

          $validate = Validator::make($request->all(),[
            'name'=>'required',
            'image'=>'required|image|mimes:png,jpg|max:2048',
            'price'=>'required',
        ]);

         if ($validate->fails()){
            return response()->json($validate->errors(),422);
         }

        $image = $request->file('image');
        $image->storeAs('public/product',$image->hashName());

        $product = Product::where('id',$id)->update(
            [
            'name'=> $request->name,
            'image'=>$image->hashName(),
            'price'=>$request->price,
        ]
    );
        $product = Product::find($id);
        return response()->json($product);
    }

    public function deleteProduct($id){

        $product = Product::where('id',$id)->delete();

        if ($product){
            return response()->json(['message'=>'successful']);

        }

        return response()->json(['message'=>'un-successful']);


    }


    //---------------------BRANCH CRUD----------------------------------------------------------------
    public function createBranch(Request $request){

        $validate = Validator::make($request->all(),[
            'name'=>'required',

            'location'=>'required',
        ]);

         if ($validate->fails()){
            return response()->json($validate->errors(),422);
         }



        $branch = Branch::create([
            'name'=> $request->name,

            'location'=>$request->location,
        ]);

        return response()->json($branch);
    }

    public function showBranches(){

        $branch = Branch::all();

        return response()->json($branch);
    }
 
    public function getBranch($id){

        $branch = Branch::find($id);

        if ($branch)
        {
            return response()->json($branch);

        }
        return response()->json([
            "message"=>"user not found"
        ]
    );

    }

    public function editBranch(Request $request,$id){

        $validate = Validator::make($request->all(),[
          'name'=>'required',

          'location'=>'required',
      ]);

       if ($validate->fails()){
          return response()->json($validate->errors(),422);
       }



      $branch = Branch::where('id',$id)->update(
          [
          'name'=> $request->name,

          'location'=>$request->location,
      ]
  );
      $branch = Branch::find($id);
      return response()->json($branch);
  }

  public function deleteBranch($id){

    $product = Branch::where('id',$id)->delete();

    if ($product){
        return response()->json(['message'=>'successful']);

    }

    return response()->json(['message'=>'un-successful']);


}

 //---------------------SALES CRUD----------------------------------------------------------------
public function createSales(Request $request){

    $validate = Validator::make($request->all(),[
        'product_id'=>'required',

        'quantity'=>'required',

    ]);

     if ($validate->fails()){
        return response()->json($validate->errors(),422);
     }



    $sales = Sales::create([
        'product_id'=> $request->product_id,

        'quantity'=>$request->quantity,
    ]);

    $stock =Stock::find($request->product_id);
// $sales = Sales::find($id);
$sale = $sales['quantity'];

$old_available = $stock['available_product'];
$branch = $stock['branch_id'];
// $sale = $sales['quantity'];
$new_available = $old_available - $sale;

$stock = Stock::where('product_id',$request->product_id)->update([
     'product_id' => $request->product_id,
    'branch_id' => $branch,
    'available_product'=>$new_available,
]);

    return response()->json($sales);
}

public function showSales(){

    $sales = Sales::with('product')->get();

    return response()->json($sales);
}

public function getSales($id){

    $sales = Sales::with('product')->find($id);

    if ($sales)
    {
        return response()->json($sales);

    }
    return response()->json([
        "message"=>"user not found"
    ]
);

}
public function editSales(Request $request,$id){

$validate = Validator::make($request->all(),[
    'product_id'=>'required',

    'quantity'=>'required',

]);

 if ($validate->fails()){
    return response()->json($validate->errors(),422);
 }



$sales = Sales::where('id',$id)->update([
    'product_id'=> $request->product_id,

    'quantity'=>$request->quantity,
]);

// $stock = Stock::select('available_product')->where('product_id',$request->product_id)->get();
$stock =Stock::find($request->product_id);
$sales = Sales::find($id);
$sale = $sales['quantity'];

$old_available = $stock['available_product'];
$branch = $stock['branch_id'];
// $sale = $sales['quantity'];
$new_available = $old_available - $sale;

$stock = Stock::where('product_id',$request->product_id)->update([
     'product_id' => $request->product_id,
    'branch_id' => $branch,
    'available_product'=>$new_available,
]);

return response()->json($sales);

}



public function deleteSales($id){

    $sales = Sales::where('id',$id)->delete();

    if ($sales){
        return response()->json(['message'=>'successful']);

    }

    return response()->json(['message'=>'un-successful']);


}

 //---------------------STOCK CRUD----------------------------------------------------------------
public function createStock(Request $request){

    $validate = Validator::make($request->all(),[
        'product_id'=>'required',
        'branch_id'=>'required',
        'available_product'=>'required',

    ]);

     if ($validate->fails()){
        return response()->json($validate->errors(),422);
     }

    $stock = Stock::create([
        'product_id'=> $request->product_id,
        'branch_id'=>$request->branch_id,
        'available_product'=>$request->available_product,
    ]);
     $stock =Stock::with('product')->get();
    return response()->json($stock);
}

public function showStock(){

    $stock = Stock::with('product','branch')->get();

    return response()->json($stock);
}

public function getStock($id){

    $stock = Stock::with('product','branch')->find($id);

    if ($stock)
    {
        return response()->json($stock);

    }
    return response()->json([
        "message"=>"stock not found"
    ]
);

}

public function editStock(Request $request,$id){

    $validate = Validator::make($request->all(),[
        'product_id'=>'required',
        'branch_id'=>'required',
        'available_product'=>'required',

    ]);

     if ($validate->fails()){
        return response()->json($validate->errors(),422);
     }


     $stock = Stock::find($id);
  $stock = Stock::where('id',$id)->update(
      [
        'product_id'=> $request->product_id,
        'branch_id'=>$request->branch_id,
        'available_product'=>$request->available_product,
  ]
);
  $stock = Stock::find($id);
  return response()->json($stock);
}

public function deleteStock($id){

$stock = Stock::where('id',$id)->delete();

if ($stock){
    return response()->json(['message'=>'successful']);

}

return response()->json(['message'=>'un-successful']);


}

 //---------------------ROLES CRUD----------------------------------------------------------------

    //---------------------sbidhaa CRUD----------------------------------------------------------------
    public function createsbidhaa(Request $request){

        $validate = Validator::make($request->all(),[
            'name'=>'required',
             'type'=>'required',
             'threshold'=>'required',
        ]);

         if ($validate->fails()){
            return response()->json($validate->errors(),422);
         }

         $sbidhaa = Sbidhaa::create([
            'name'=> $request->name,
            'type'=>$request->type,
            'threshold'=>$request->threshold,
            'created_at'=> $date,
        ]);
        $this->sendSMS();
        return response()->json($sbidhaa);
    }
    private function sendSMS()
    {
        $phone_number = 756007671; // Replace with the actual phone number from the product data or other logic
        $sbidhaa = $this->name;
        $sms = 'hello new product has being registered';
        

        $url = 'http://smsportal.imartgroup.co.tz/app/smsapi/index.php?campaign=266&routeid=8&key=36281862404933&type=text&contacts=' . $phone_number . '&senderid=Spring-Tech&msg=' . $sms. '';

        try {
            $client = new Client();
            $response = $client->get($url);

            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) {
                return response()->json(['success' => true, 'message' => 'SMS sent successfully']);
            } else {
                return response()->json(['success' => false, 'message' => 'Failed to send SMS']);
            }
        } catch (GuzzleException $e) {
            return response()->json(['success' => false, 'message' => 'Error occurred while sending SMS']);
        }
    }

    public function showbidhaa(){

        $sbidhaa = Sbidhaa::all();

        return response()->json($sbidhaa);
    }
 
    public function getbidhaa($id){

        $sbidhaa = Sbidhaa::all();

        if ($sbidhaa)
        {
            return response()->json($sbidhaa);

        }
        return response()->json([
            "message"=>"Product not found"
        ]
    );

    }

    public function editsbidhaa(Request $request,$id){

        $validate = Validator::make($request->all(),[
            'name'=>'required',
            'type'=>'required',
            'threshold'=>'required',
      ]);

       if ($validate->fails()){
          return response()->json($validate->errors(),422);
       }



      $branch = Branch::where('id',$id)->update(
          [
            'name'=> $request->name,
            'type'=>$request->type,
            'threshold'=>$request->threshold,
            'created_at'=> $date,
      ]
  );
      $sbidhaa = Sbidhaa::find($id);
      return response()->json($sbidhaa);
  }

  public function deletebidhaa($id){

    $sbidhaa = Sbidhaa::where('id',$id)->delete();

    if ($sbidhaa){
        return response()->json(['message'=>'successful']);

    }

    return response()->json(['message'=>'un-successful']);


}

}

