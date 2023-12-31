<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Branch;
use App\Models\User;
use App\Models\Payment;
use App\Models\Sbidhaa;
use App\Models\Expense;
use App\Models\Product;
use App\Models\Debt;
use App\Models\Order;
use App\Models\Sell;
use App\Models\ShopInfo;
use Hash;
use Auth;
use DB;
use Toastr;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;
use MultipleIterator;
use ArrayIterator;
use App\Imports\ProductImport;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

use App\Mail\NewProductNotification;
use Illuminate\Support\Facades\Mail;

use App\Mail\SendAutomaticEmail;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

use App\Events\NewProductRegistered;
// use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Http;


class BackendController extends Controller
{

    //==================FUNCTIONS FOR BRANCHES=====================
    public function createBranch(Request $request){

       $data = Branch::where('name', '=' ,$request->branchname)->where('location', '=' ,$request->location)->first();
       $date = Carbon::now();

       if ($data != null){
        
        return back()->with('error','The name of the branch is already available! Choose another one.');;
       }

        $validate = Validator::make($request->all(),[
            'branchname'=>'required',
            'location'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'address'=>'required',

        ]);

         if ($validate->fails()){
            $messages = $validate->messages();
            Alert::error('errors','There is an error during data entry');
            return back();
         }



        $branch = Branch::create([
            'name'=> $request->branchname,
            'location'=>$request->location,
            'email'=>$request->email,
            'address'=>$request->address,
            'phoneNumber'=>$request->phone,
            'created_at'=> $date,
        ]);
         
        Alert::success('message','The record has been entered successfully.');
        return back();
       
    }

    public function deleteBranch($id){

        $product = Branch::where('id',$id)->delete();        
        return back();
        if ($product){
             Alert::success("Deleted!","The record has been deleted.", "success");
            return back();         

        }
        Alert::error("Cancelled", "The record was not deleted.", "info");
        return back();
     
    }

    public function editBranch(Request $request,$id){
        $date = Carbon::now();
        $validate = Validator::make($request->all(),[
          'name'=>'required',
          'location'=>'required',
      ]);

      if ($validate->fails()){
        $messages = $validate->messages();
        return back()->with('error',$messages);
     }



      $branch = Branch::where('id',$id)->update(
          [
          'name'=> $request->name,
          'location'=>$request->location,
          'email'=>$request->email,
          'address'=>$request->address,
          'phoneNumber'=>$request->phone,
          'updated_at'=>$date
      ]
  );
  Alert::success('message','The record has been received completely.');
  return back();

  }



//==================FUNCTIONS FOR USERS===========

  public function createUser(Request $request)

    {
        $date = Carbon::now();
        $data = User::where('email', '=' ,$request->email)->first();
        if ($data != null){
            Alert::error('error','The worker is already present. Please add another one.');
            return back();
           }
        $validate = Validator::make($request->all(),
        [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' =>'required|digits_between:2,10',
            'address' => 'required',
            'gender'=>'required',
            'branch'=>'required',
            'roles' => 'required'
        ]);

        if ($validate->fails()){
            $messages = $validate->messages();
            Alert::error('error','There is an error during data entry');
            return back();            
        }

        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->branch_id = $request->branch;
        $user->password = Hash::make("12345");
        $user->created_at =$date;
        $user->status=1;
        $user->save();
        $user->assignRole($request->input('roles'));
        Alert::success('message','Mfanayakazi amewekwa kikamilifu');
        return back();
    }


    public function editUser(Request $request, $id)
    {
        // $data = User::where('email', '=' ,$request->email)->first();
        // if ($data != null){
        //     return back()->with('error','Mfanyakazi Tayari yupo Tafadhali Ongeza Mwingine');
        //    }
        $date = Carbon::now();
        $validate = Validator::make($request->all(),
        [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' =>'required|digits_between:2,10',
            'address' => 'required',
            'gender'=>'required',
            'branch'=>'required',
            'roles' => 'required'

        ]);



        if ($validate->fails()){
            $messages = $validate->messages();
            Alert::error('error','There is an error during data entry');
           
         }
        $user = User::find($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->branch_id = $request->branch;
        $user->updated_at=$date;
        $user->password = Hash::make("12345");
        $user->status=1;
        $user->save();
        $user->removeRole($user->roles->first()->name);
        $user->assignRole($request->input('roles'));
        Alert::success('message','The record has been updated successfully');
        return back();
    }
    public function deleteUser($id){

        $product = User::where('id',$id)->delete();

        if ($product){
            Alert::success('message','The user has been deleted successfully');
            return back();           

        }
        Alert::success('error','There was an error during data deletion.');
        return back();
   


    }
    public function login(Request $request)
    {
        $date = Carbon::now()->toDateTimeString();

        $validate = Validator::make($request->all(),
        [
            'email' => 'required|email|unique:users,email',
            'password' =>'required',
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
           $user = Auth::user();
           $user->last_login=$date;
           $user->save();      
        return redirect('/dashboard')->with('message','login successful');
        }
        else{
            return back()->with('error','Incorrect Email or Password,Please then try again.');
        }      


    }
    public function logout(Request $request){

        Auth::logout();
        return redirect('/');
    }
    public function search(Request $request)
    {
        $pd=Product::with('sbidhaa')->get();
        // $fromDate = $request->input('fromDate');
        // $toDate   = $request->input('toDate');
        //$other    = $request->input('other'); 

        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');
        $productId = $request->input('productId');
    
        $query = DB::table('sells')
            ->select('product_id', 'quantity', 'created_at', 'amount');
    
        // Apply date range filter
        if ($fromDate && $toDate) {
            $query = Sell::whereBetween('created_at',array($fromDate." 00:00:00",$toDate." 23::59:59"))->get();
        }
    
        // Apply product ID filter
        if ($productId) {
            $query->where('product_id', $productId);
        }
        $role = Role::all();
        return view('layouts.report',compact('query','role','pd'));
    }


public function delete($id)
    {
        $order = Order::where('id',$id)->delete();

    if ($order){
        Alert::success('message','The order has been deleted successfully');     
        return redirect()->back();
    }
    Alert::error('error','There is an error during product entry');     
    return redirect()->back();
        // Order::where('id',$id)->delete();
        // return redirect()->back()->with('message','The order has been deleted susccessfully');
   }

   public function update(Request $request,$id)
    {
        $update = [
                'name'           =>  $request->name,
                'sex'            =>  $request->sex,
                'date_of_birth'  =>  $request->dateOfBirth,
                'email'          =>  $request->email,
                'phone'          =>  $request->phone,
                'job_position'   =>  $request->jobPosition,
                'salary'         =>  $request->salary

            ];
        Sell::find($id)->update($update);
        Alert::success('message','The record has been entered successfully');     
        return redirect()->back();
     
    }
    
    
  //The function for the sale_report
  public function reports(Request $request){   
    $sell=Sell::get();
    $pd=Product::with('sbidhaa')->get();
    
    $fromDate = $request->input('fromDate');
    $toDate   = $request->input('toDate');
    $p = $request->input('product_id');
    $role = Role::all();  
    
    if(count($request->all()) > 0){
        $data=Sell::with('product')
        ->join('products', 'sells.product_id', '=', 'products.id')
        ->select('sells.product_id', DB::raw('SUM(sells.quantity) as quantity'), DB::raw('SUM(sells.total_amount * sells.quantity) as amount'), DB::raw('SUM(sells.profit) as profit'))
        ->where('sells.status', 'IMEUZWA')
        ->whereBetween('sells.created_at', [$fromDate." 00:00:00", $toDate." 23:59:59"])
        ->groupBy('sells.product_id')
        ->get();

        $b=Payment::whereBetween('created_at',array($fromDate." 00:00:00",$toDate." 23::59:59"))->sum('amount');
        
        $pius = Sell::with('product')
        ->whereBetween('created_at', [$fromDate . " 00:00:00", $toDate . " 23:59:59"])
        ->where('status', 'IMEUZWA')
        ->where('product_id', $p)
        ->sum(\DB::raw('total_amount * quantity'));
        // $a = $result->amount;
        // $pius=$a+$b;
        $sikup = Sell::with('product')
       ->whereBetween('created_at', [$fromDate . " 00:00:00", $toDate . " 23:59:59"])
       ->where('status', 'IMEUZWA')
       ->where('product_id', $p)
       ->sum('profit');

       return view('layouts.report',compact('data','pius','sikup','pd'));
    }
    else{
        $data=Sell::with('product')
        ->join('products', 'sells.product_id', '=', 'products.id')
        ->select('sells.product_id', DB::raw('SUM(sells.quantity) as quantity'), DB::raw('SUM(sells.total_amount * sells.quantity) as amount'), DB::raw('SUM(sells.profit) as profit'))
        ->where('sells.status', 'IMEUZWA')
        ->whereBetween('sells.created_at', [$fromDate." 00:00:00", $toDate." 23:59:59"])
        ->groupBy('sells.product_id')
        ->get();
        $b=Payment::whereBetween('created_at',array($fromDate." 00:00:00",$toDate." 23::59:59"))->sum('amount');
        
        $pius = Sell::with('product')
        ->whereBetween('created_at', [$fromDate . " 00:00:00", $toDate . " 23:59:59"])
        ->where('status', 'IMEUZWA')
        ->where('product_id', $p)
        ->sum(\DB::raw('total_amount * quantity'));
        // $a = $result->amount;
        // $pius=$a+$b;
        $sikup = Sell::with('product')
       ->whereBetween('created_at', [$fromDate . " 00:00:00", $toDate . " 23:59:59"])
       ->where('status', 'IMEUZWA')
       ->where('product_id', $p)
       ->sum('profit');
       return view('layouts.report',compact('data','pius','sikup','pd'));
    }
    
}
    
// ===============product_functions===================
public function createProduct(Request $request){
    $date = Carbon::now();
    $net_amount = $request->amount - (($request->discount / 100)*$request->amount);
     $validate = Validator::make($request->all(),[         
         'quantity'=>'required',
         'bprice'=>'required',
         'amount'=>'required',
         'branch'=>'required',
         'category'=>'required',
         'sbidhaa'=>'required',
         'discount'=>'required',
     ]);
     
      if ($validate->fails()){
        
         $messages = $validate->messages();
         Alert::error('message','There was an error during data entry');
         return redirect()->back();
      }
        
     $a=$request->quantity;
     $b=$request->sub_quantity;
     $c=$request->category;
    
     
     if($c==1){
     $product = new Product;      
     $product->quantity = $a;
     $product->bprice = $request->bprice;
     $product->amount = $request->amount;
     $product->capital = $request->amount * $request->quantity;
     $product->pprofit =($request->amount - $request->bprice);
     $product->sub_quantity = $b;
     $product->sub_amount = $request->amount;
     $product->net_amount = $net_amount;
     $product->total_quantity = $request->sub_quantity * $request->quantity;
     $product->branch_id = $request->branch;
     $product->category_id = $c;
     $product->sbidhaa_id = $request->sbidhaa;
     $product->discount=$request->discount;
     $product->created_at = $date;
   
     $product->save();
     }
     elseif($c==2){
       $product = new Product;      
       $product->quantity = $a*$b;
       $product->bprice = $request->bprice;
       $product->amount = $request->amount;
       $product->capital = $request->amount * $request->quantity;
       $product->pprofit =($request->amount - $request->bprice);
       $product->sub_quantity = $b;
       $product->sub_amount = $request->amount;
       $product->net_amount = $net_amount;
       $product->total_quantity = $request->sub_quantity * $request->quantity;
       $product->branch_id = $request->branch;
       $product->category_id = $c;
       $product->sbidhaa_id = $request->sbidhaa;
       $product->discount=$request->discount;
       $product->created_at = $date;
       $product->save();
       }
    else{
        Alert::error('message','Hamna kitu');
        return redirect()->back(); 
    }
    
     Alert::success('message','The record has been entered successfully');
    
     return redirect()->back();
 }


 public function upload(Request $request){
//   $path = storage_path() . '/app/' . request()->file->store('tmp');

//   dd($path);

  Excel::import(new ProductImport, $request->file('file'));
  Alert::success('message','The record has been uploaded successfully');     
  return redirect()->back();
  

 }

 public function deleteProduct($id){

    $product = Product::where('id',$id)->delete();

    if ($product){
        Alert::success('message','The product has been deleted successfully');     
        return redirect()->back();
    }
    Alert::error('error','There is an error during product entry');     
    return redirect()->back();
    
}

public function editProduct(Request $request, $id){
    $date = Carbon::now();
    $net_amount = $request->amount - (($request->discount / 100)*$request->amount);
    $validate = Validator::make($request->all(),[
        
        // 'quantity'=>'required',
        'bprice'=>'required',
        'amount'=>'required',
        'branch'=>'required',
        'sbidhaa'=>'required',

    ]);

     if ($validate->fails()){
        $messages = $validate->messages();
        return back()->with('error',$messages);
     }
    
        $a=$request->quantity;
        $product = Product::find($id);
        
        if($product->category_id==1){
            $product->quantity = $product->quantity+$a;
            $product->bprice = $request->bprice;
            $product->capital = $request->amount * $product->quantity;
            $product->pprofit =($request->amount - $request->bprice);
            $product->sub_quantity = $product->sub_quantity;
            $product->sub_amount = $product->sub_amount;
            $product->amount = $request->amount;
            $product->net_amount = $net_amount;
            $product->branch_id = $request->branch;
            $product->sbidhaa_id = $request->sbidhaa;
            $product->discount=$request->discount;
            $product->updated_at = $date;
            $product->save();
        
            Alert::success('message','The product has been updated successfully');     
            return redirect()->back();
        }
        elseif($product->category_id==2){
            $product->quantity = $product->quantity + ($a*$request->sub_quantity);
            $product->bprice = $request->bprice;
            $product->capital = $request->amount * $product->quantity;
            $product->pprofit =($request->amount - $request->bprice);
            $product->sub_quantity = $request->sub_quantity;
            $product->sub_amount = $product->sub_amount;
            $product->amount = $request->amount;
            $product->net_amount = $net_amount;
            $product->branch_id = $request->branch;
            $product->sbidhaa_id = $request->sbidhaa;
            $product->discount=$request->discount;
            $product->updated_at = $date;
            $product->save();
        
            Alert::success('message','The product has been updated successfully');     
            return redirect()->back();
        }
        else{
            Alert::error('message','There infomation entered is wrong, Try again!!');     
            return redirect()->back();
        }
        
   
    
    
}

public function addToCart(Request $request ,$id) // by this function we add product of choose in card
{
    $product = Product::find($id);

    if(!$product) {

        abort(404);

    }

    // if cart is empty then this the first product
    if($product->quantity-$request->quantity < 0){
        Alert::error('error','The product is not enough, Please try to add the stock');     
        return redirect()->back();
        
    }
    $cart = session()->get('cart');
    if(!$cart) {

        $cart = [
        $id => [
        'id'=>$product->id,       
        'net_amount'=>$product->net_amount,
        'quantity'=>$request->quantity,
        'discount'=>$product->discount,
        'branch_id'=>$product->branch->id,
        'category_id'=>$product->category->id,
        'sbidhaa_id'=>$product->sbidhaa->name,
        'pprofit'=>$product->pprofit,
        'sub_amount'=>$product->sub_amount,
        ]
        ];

        session()->put('cart', $cart);
        // Alert::success('message', 'Bidhaa imewekwa kwenye Mkikoteni kikamilifu!');     
        return redirect()->back();
       
    }

    // if cart not empty then check if this product exist then increment quantity
    if(isset($cart[$id])) {

        // this code put product of choose in cart
        Alert::error('error', 'The product Allready exist.');     
        return redirect()->back();
       
    }
    if(isset($cart[$id]['branch_id'])) {

        // this code put product of choose in cart
        Alert::error('error', 'The branches are not correct, Please choose one branch');     
        return redirect()->back();
    }

    // if item not exist in cart then add to cart with quantity = 1
    $cart[$id] = [
        'id'=>$product->id,
        // 'name'=>$product->name,
        // 'type'=>$product->type,
        'net_amount'=>$product->net_amount,
        'quantity'=>$request->quantity,
        'discount'=>$request->discount,
        'branch_id'=>$product->branch->id,
        'category_id'=>$product->category->id,
        'sbidhaa_id'=>$product->sbidhaa->name,
        'pprofit'=>$product->pprofit,
        'sub_amount'=>$request->sub_amount,
    ];

    session()->put('cart', $cart); // this code put product of choose in cart
    //Alert::success('message', 'Bidhaa imewekwa kikamilifu');

    return redirect()->back();
}

public function updateCart(Request $request)
 {
    $product = Product::find($request->id);
     if($request->id and ($request->quantity or $request->sub_quantity))
     {
         $cart = session()->get('cart');
         if($product->quantity-$request->quantity < 0 or $product->total_quantity-$request->sub_quantity < 0){
            Alert::error('error','The product is not enough, Please try to add the stock');
            return back();
        }
         $cart[$request->id]["quantity"] = $request->quantity;

         $cart[$request->id]["sub_quantity"] = $request->sub_quantity;
         session()->put('cart', $cart);
         
         alert::success('message', 'Cart updated successfully');
         return redirect()->back();
     }
     alert::success('message', 'Cart updated successfully');
     return redirect()->back();
     
 }

 public function deleteCart(Request $request)
 {

     if($request->id) {

         $cart = session()->get('cart');

         if(isset($cart[$request->id])) {

             unset($cart[$request->id]);

             session()->put('cart', $cart);
         }
        
        //session()->flash('message', 'The product removed successfully');
         return back()->with('message', 'The product removed successfully');
     }
 }


 ///////hesabu=====================
 public function checkout(Request $request){

    $date = Carbon::now();
    // $net_amount = $request->amount - (($request->discount / 100)*$request->amount);

     $validate = Validator::make($request->all(),[

         'total_amount'=>'required',

     ]);

      if ($validate->fails()){
         $messages = $validate->messages();
         Alert::error('error','There is an error during data entry');
         return back();
      }

    $na = ($request->total_amount - $request->discount);
    $nA =  $na*(($request->vat)/100);
    $nA = $nA+$na;
    $osd=$request->status;
     $order = new Order;
     $order->user_id = Auth::user()->id;
     $order->customer_name = $request->customer_name;
     $order->phonenumber = $request->phonenumber;
     $order->discount = $request->discount;
     $order->total_quantity = $request->total_quantity;
     $order->status = $osd;
     $order->vat = $request->vat;
     $order->org_amount = $na;
     $order->total_amount = $nA;
     $order->created_at = $date;
     $order->save();
    
     $mi = new MultipleIterator();
     $mi->attachIterator(new ArrayIterator($request->product));
     $mi->attachIterator(new ArrayIterator($request->quantity));
     $mi->attachIterator(new ArrayIterator($request->pprofit));
     $mi->attachIterator(new ArrayIterator($request->amount));
     

     foreach($mi as list($p,$q,$a)){
        $product = Product::find($p);
        if($product->category_id == 2){
            $total = $product->quantity-$q;
            $capitals=$total*$product->amount;
           
            $product->quantity = $total;
           $product->capital=$capitals;
            //$product->capital=$pius;
            $product->save();
            // $this->sendSMS();
        }else{
            $product->quantity=$product->quantity - $q;

            $capitals=( $product->quantity*$product->amount);
            //dd($capitals);
            $product->capital=$capitals;
            
           
           // $product->capital=$product->capital-$p;
            $product->save();
            
        }
        // $this->sendSMS();
     }
     $order->status = $request->status;
     if($osd == "MKOPO"){           
            $debt = new Debt;       
            $debt->order_id = $order->id;
            // $debt -> quantity = $q;                       
            $debt -> amount =$na;                 
            $debt->save();
            foreach($mi as list($p,$q,$t,$a)){
                $product = Product::find($p);
                $sells = new Sell;
                $sells->customer_name = $request->customer_name;       
                $sells->phonenumber = $request->phonenumber;
                $sells->order_id = $order->id;
                $sells->status =$request->status;
                $sells -> product_id = $p;
                if($product->category_id == 2){
                $sells->profit=$t*$q;
                $sells -> quantity = $q;
                $sells -> total_amount = $a;
                // $sells->net_amount=$a*$q;
                $sells->save();
                }
                else{
                    $sells->profit=$t*$q;
                    $sells -> quantity = $q;
                    $sells -> total_amount = $a;
                    // $sells->net_amount=$a*$q;
                    $sells->save();
                }          
               
           }
            $request->session()->forget('cart');
            Alert::success('message','The product has been Loaned successfully');
            return back();
     
     }
     
        foreach($mi as list($p,$q,$t,$a)){
            $product = Product::find($p);
            $sells = new Sell;
            $sells->customer_name = $request->customer_name;       
            $sells->phonenumber = $request->phonenumber;
            $sells->order_id = $order->id;
            $sells->status =$request->status;
            $sells -> product_id = $p;
            if($product->category_id == 2){
            $sells->profit=$t*$q;
            $sells -> quantity = $q;
            $sells -> total_amount = $a;
            // $sells->net_amount=$a*$q;
            $sells->save();
            }
            else{
                $sells->profit=$t*$q;
                $sells -> quantity = $q;
                $sells -> total_amount = $a;
                // $sells->net_amount=$a*$q;
                $sells->save();
            }          
           
       }
        
        
     $request->session()->forget('cart');
     Alert::success('message','The product has been sold successfully');
     return back();

  }






public function viewPDF($id){
    $date = Carbon::now();
    $s = Sell::with(['product','order'])->where('order_id',$id)->get();
    $o = Order::where('id',$id)->get();
    $order = Order::find($id)->get();
    $pdf = Pdf::setOption(['isRemoteEnabled'=>true, 'isHtml5ParseEnabled'=>true]);
    // $pdf::loadView('pdf.risiti',compact('date','s','o'));
    $pdf->loadView('pdf.risiti',compact('date','s','o','order'));
    return $pdf->stream('mauzo.pdf');
}

public function previewPDF($id){
    $date = Carbon::now();
    $s = Sell::with(['product','order'])->where('order_id',$id)->get();
    $o = Order::where('id',$id)->get();
    $order = Order::find($id)->get();
    $pdf = Pdf::setOption(['isRemoteEnabled'=>true, 'isHtml5ParseEnabled'=>true]);
    // $pdf::loadView('pdf.risiti',compact('date','s','o'));
    $pdf->loadView('pdf.prerisiti',compact('date','s','o','order'));
    return $pdf->stream('order.pdf');
}


public function addRole(Request $request){
    $role = Role::create(['name' => $request->name]);

        $permissions = $request->permission;

        $role->syncPermissions($permissions);

        if ($role){
            return back()->with('message','The record has been entered successfully');
        }
        return back()->with('error','The record has been entered successfully');
}

public function deleteRole(Request $request,$id){
    $role = Role::find($id);

       $role->delete();
        if ($role){
            return back()->with('message','The role has been deleted successfully');
        }
        return back()->with('error','There is an error during data deletion');
}

public function editRole(Request $request,$id){
    $role = Role::find($id);

    $role->update(['name' => $request->name]);

    $permissions = $request->permission;

    $role->syncPermissions($permissions);

    if ($role){
        return back()->with('message','The record has been entered successfully');
    }
    return back()->with('error','The record has been entered successfully');
}

public function changepassword(Request $request){

if(!(Hash::check($request->old, Auth::user()->password))){
    Alert::error('error','Your old password is not correct');
    return back(); 

}
if($request->old == $request->new){
    Alert::error('error','The new password cant be the same with old one');
    return back(); 
   
}
$validate = Validator::make($request->all(),[

    'old'=>'required',
    'new'=> 'required|string|min:8',
]);
if ($validate->fails()){
    $messages = $validate->messages();
    return back()->with('error',$messages);
 }
$user = Auth::user();
$user->password = bcrypt($request->new);
$user->save();
if($user){
    Auth::logout();
    Alert::success('message','Your password is successfully changed, Login again');
    return redirect('/');
}

}

public function changeinfo(Request $request){

    $date = Carbon::now();
    $validate = Validator::make($request->all(),
    [
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required',
        'phone' =>'required|digits_between:2,10',
        'address' => 'required',
        'gender'=>'required',


    ]);



    if ($validate->fails()){
        $messages = $validate->messages();
        Alert::error('error','There is an error during data entry');
        return back();        
     }


    $user = Auth::user();
    $user->first_name = $request->first_name;
    $user->last_name = $request->last_name;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->address = $request->address;
    $user->gender = $request->gender;
    $user->save();
    Alert::success('message','The record has been changed successfully');
    return back();

}

public function makeorder(Request $request){

    $date = Carbon::now();
    // $net_amount = $request->amount - (($request->discount / 100)*$request->amount);

     $validate = Validator::make($request->all(),[

         'total_amount'=>'required',

     ]);

      if ($validate->fails()){
         $messages = $validate->messages();
         return back()->with('error','There is error during data entry!!');
      }
$na = ($request->total_amount - $request->discount);
$nA =  $na*(($request->vat)/100);
$nA = $nA+$na;
 $order = new Order;
 $order->user_id = Auth::user()->id;
 $order->customer_name = $request->customer_name;
 $order->phonenumber = $request->phonenumber;
 $order->discount = $request->discount;
 $order->total_quantity = $request->total_quantity;
 $order->status = "HAIJAUZWA";
 $order->vat = $request->vat;
 $order->org_amount = $na;
 $order->total_amount = $nA;
 $order->created_at = $date;
 $order->save();
 $mi = new MultipleIterator();
 $mi->attachIterator(new ArrayIterator($request->product));

 $mi->attachIterator(new ArrayIterator($request->quantity));
 $mi->attachIterator(new ArrayIterator($request->pprofit));
 $mi->attachIterator(new ArrayIterator($request->amount));


 foreach($mi as list($p,$q,$t,$a)){
    $product = Product::find($p);
    $sells = new Sell;
    $sells->customer_name = $request->customer_name;
    $sells->phonenumber = $request->phonenumber;
    $sells->order_id = $order->id;
    // kuku
    $sells->status = "HAIJAUZWA";
    $sells -> product_id = $p;
    if($product->category_id == 2){
        $sells->profit=$t*$q;
        $sells -> quantity = $q;
        $sells -> total_amount = $a;
        // $sells->net_amount=$a*$q;
        $sells->save();
        }
        else{
            $sells->profit=$t*$q;
            $sells -> quantity = $q;
            $sells -> total_amount = $a;
            // $sells->net_amount=$a*$q;
            $sells->save();
        }  

}
    //  $product->quantity = $product->quantity - $a;
    //  $product->save();
     $request->session()->forget('cart');
     Alert::success('message','The record has been orderd successfully');
     return back();

 }


 public function updateorder(Request $request,$id){

    $date = Carbon::now();
    // $net_amount = $request->amount - (($request->discount / 100)*$request->amount);

     $validate = Validator::make($request->all(),[

         'total_amount'=>'required',

     ]);

      if ($validate->fails()){
         $messages = $validate->messages();
         Alert::error('error','There is error during data entry!!');
         return back();
      }
$na = ($request->total_amount - $request->discount);
$nA =  $na*(($request->vat)/100);
$nA = $nA+$na;
     $order = Order::find($id);
     $order->user_id = Auth::user()->id;
     $order->customer_name = $request->customer_name;
     $order->phonenumber = $request->phonenumber;
     $order->status = "HAIJAUZWA";
     $order->discount = $request->discount;
     $order->vat = $request->vat;
     $order->org_amount = $na;
     $order->total_amount = $nA;
     $order->created_at = $date;
     $order->total_quantity = $request->total_quantity;
     $order->save();
     $mi = new MultipleIterator();
     $mi->attachIterator(new ArrayIterator($request->product));

     $mi->attachIterator(new ArrayIterator($request->quantity));
     $mi->attachIterator(new ArrayIterator($request->amount));
     foreach($mi as list($p,$q,$a)){
        $sells = new Sell;
        $sells->customer_name = $request->customer_name;
        $sells->phonenumber = $request->phonenumber;
        $sells->order_id = $order->id;
        $sells -> product_id = $p;
        $sells -> quantity = $q;
        $sells -> amount = $a;
        $sells->save();


}
    //  $product->quantity = $product->quantity - $a;
    //  $product->save();
     $request->session()->forget('cart');
     Alert::success('message','The record has been entered successfully');
     return back();

 }

 public function removeProduct(Request $request,$id){
    $role = Sell::where('product_id',$id);

    $order = Order::find($request->id);
    $order->total_quantity = ($order->total_quantity - $request->total_quantity);
    $order->save();
    if($order->total_quantity <=0){
        $order->delete();
        $role->delete();
    }
    $role->delete();
        if ($role){
            Alert::success('message','umefanikiwa');
            return back();
        }
        Alert::error('error','There is an error during data deletion');
        return back();
}

public function editOrders(Request $request,$id){

    $sells= Sell::find($id);


    if ($sells){
    $sells->quantity = $request->quantity;
    $sells->save();
    Alert::success('message','umefanikiwa');
    return back();
    }
    Alert::error('error','There is an error during data deletion');
    return back();

}

public function updateShop(Request $request,$id){
    $date = Carbon::now();

    $shop = ShopInfo::where('id',$id)->update(
        [
        'name'=> $request->name,

        'location'=>$request->location,
          'email'=>$request->email,
          'address'=>$request->address,
          'phoneNumber'=>$request->phone,
          'mobile1'=>$request->mobile1,
          'mobile2'=>$request->mobile2,
          'mobile3'=>$request->mobile3,
          'AccountNumber1'=>$request->AccountNumber1,
          'AccountNumber2'=>$request->AccountNumber2,
          'AccountNumber3'=>$request->AccountNumber3,
          'slogan'=>$request->slogan,
          'MainBranch'=>$request->MainBranch,
          'TIN'=>$request->TIN,
          'website'=>$request->website,
           'updated_at'=>$date
        ]);
        Alert::success('message','The infortiona has been changed successfully');
        return back();
        
}
    //==================FUNCTIONS FOR SAJILI PRODUCT=====================
    public function createsbidhaa(Request $request){

        $data = Sbidhaa::where('name', '=' ,$request->name)->where('type', '=' ,$request->type)->first();
        $date = Carbon::now();
 
        if ($data != null){
            return back()->with('errors','There is error during data entry!!');
        }
 
         $validate = Validator::make($request->all(),[
             'name'=>'required',
             'type'=>'required',
             'threshold'=>'required',
          
 
         ]);
 
          if ($validate->fails()){
             $messages = $validate->messages();
             return back()->with('errors','There is error during data entry!!');
          }
 
 
         $sbidhaa = Sbidhaa::create([
             'name'=> $request->name,
             'type'=>$request->type,
             'threshold'=>$request->threshold,
             'created_at'=> $date,
         ]);      
                // Assuming the registration is successful
            // $message = 'Product registered successfully';
            // $status = 'success';

            // // Redirect back with a flash message
            // return redirect()->back()->with([
            //     'status' => $status,
            //     'message' => $message
            // ]);   
                
        // Alert::success('message','The record has been entered successfully');
        return back()->with('message','The record has been entered successfully');
        
     }


     public function deletesbidhaa($id){

        $product = sbidhaa::where('id',$id)->delete();

        if ($product){
            
            Alert::success("Deleted!", "The record has been deleted.", "success");
            return back();           

        }
        Alert::error("Cancelled", "The record was not deleted.", "info");
        return back();
     
    }

    

    public function editsbidhaa(Request $request,$id){

        $date = Carbon::now();

        $validate = Validator::make($request->all(),[
          'name'=>'required',
          'type'=>'required',
          'threshold'=>'required',
      ]);

      if ($validate->fails()){
        $messages = $validate->messages();
        return back()->with('error',$messages);
     }

      $data = Sbidhaa::where('id',$id)->update(
          [
          'name'=> $request->name,
          'type'=>$request->type,
          'threshold'=>$request->threshold,
          'updated_at'=>$date
      ]
        );
        
  return back()->with('message','The product has been updated successfully');

  }


//==============Expenses Function====================

public function createMatumizi(Request $request){

    $date = Carbon::now();
     $validate = Validator::make($request->all(),[
         'description'=>'required',
         'amount'=>'required',       

     ]);

      if ($validate->fails()){
         $messages = $validate->messages();       
         return back()->with('errors','There is error during data entry!!');
      }

     $expenses = Expense::create([
         'description'=> $request->description,
         'amount'=>$request->amount,
         'created_at'=> $date,
     ]);     
               
     
     return back()->with('message','The Expenses has been entered successfully');
    
 }

 public function editMatumizi(Request $request,$id){

    $date = Carbon::now();

    $validate = Validator::make($request->all(),[
      'description'=>'required',
      'amount'=>'required',
      
  ]);

  if ($validate->fails()){
    $messages = $validate->messages();
    return back()->with('error',$messages);
 }

  $data = Expense::where('id',$id)->update(
      [
      'description'=> $request->description,
      'amount'=>$request->amount,
        'updated_at'=>$date
  ]
    );
    
    return back()->with('message','The Expenses has been updated successfully');

}

    public function deleteMatumizi($id){

        $expenses = Expense::where('id',$id)->delete();

        if ($expenses){
            
            return back()->with('message','Expense has been deleted successfully');           

        }
        return back()->with('message','There is an error during data deletion');          
     
    }

    public function filter(Request $request)
    {
        $filter = $request->input('filter');
        $expenses = Expense::query();

        if ($filter === 'daily') {
            $expenses = $expenses->whereDate('created_at', today());
        } elseif ($filter === 'monthly') {
            $expenses = $expenses->whereMonth('created_at', today()->format('m'));
        } elseif ($filter === 'custom') {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
           $expenses = $expenses->whereBetween('created_at', [$startDate, $endDate . ' 23:59:59']);
            
        }

        $expenses = $expenses->latest()->paginate(10);
        return view('layouts.matumizi', compact('expenses'));
    }

    public function s(Request $request,$id){

         $date = Carbon::now();
    
    //     $validate = Validator::make($request->all(),[
    //       'description'=>'required',
    //       'amount'=>'required',
          
    //   ]);
    
    //   if ($validate->fails()){
    //     $messages = $validate->messages();
    //     return back()->with('error',$messages);
    //  }
    
      $data = Debit::where('id',$id)->update(
          [
          'order_id'=> $request->order_id,
          'amount'=>$request->amount,
            'updated_at'=>$date
      ]
        );
       
        Alert::success('message','Taarifa zimebadilika kikamilifu');
        return back();
    
    }


    public function payment(Request $request)
    {
        $sell=Sell::get();
        $loan=Debt::with('order')->get();
        $p = $request->input('order_id');
        $paidAmount = $request->input('paid_amount');    
    
        $debt = Debt::where('order_id', $p)->first();
    
        if ($debt) {
            if ($debt->amount >= $paidAmount) {
                $debt->amount -= $paidAmount;
                $debt->save();
        
                $payment = new Payment();
                $payment->order_id = $p;
                $payment->debt_id = $debt->id;
                $payment->amount = $paidAmount;               
                $payment->save();
               
            }elseif($paidAmount > $debt->amount) {
                return back()->with('error','The payment amont is greater than the debt amount,The value must be less or equal to the debt amount');
            }
            else {      
        
                $payment = new Payment();
                $payment->order_id = $p;
                $payment->debt_id = $debt->id;
                $payment->amount = $debt->amount;                
                $payment->save();
        
                // $payment = new Payment();
                // $payment->order_id = $p;
                // $payment->debt_id = null;
                // $payment->amount = $paidAmount;               
                // $payment->save();            
              
            }
        }
        $order = Order::find($p);
        $order->total_amount -= $paidAmount;
        $order->save();
       
        if ($order->total_amount == 0 && $debt->amount == 0) {
            // Update the status in the order table
            $order->status = 'IMEUZWA';
            $order->save();
        
           
            $debt->status = 'PAID';
            $debt->save();

            // Update the status in the sells table
            $sell = Sell::where('order_id', $p)->first();
            $sell->status = 'IMEUZWA';
            $sell->save();
            // return back()->with('message','The User has paid full debit successfully');
        }
       
    return back()->with('message','The payment done successfully');
        //return view('layouts.madeni',compact('debt','loan'));
        
    }

}
