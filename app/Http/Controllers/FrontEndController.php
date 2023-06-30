<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\User;
use App\Models\Expense;
use App\Models\Sbidhaa;
use App\Models\Debt;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\Sell;
use App\Models\ShopInfo;
use RealRashid\SweetAlert\Facades\Alert;
use Hash;
use Auth;
use Dompdf\Dompdf;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use DB;
use Illuminate\Support\Facades\Mail;
use Swift_Attachment;
use ZanySoft\LaravelPDF\PDF;
use Illuminate\Support\Arr;
// use Illuminate\Support\Facades\Session;
class FrontEndController extends Controller
{

    public function showlogin(){

        return view('auth.login');
    }


    public function index(){


        return view('index');
    }

    public function product(){
         return view('layouts.product');
    }
    //the fuction for the admin
    public function admin(){
        return view('layouts.admin');
    }
    //The function for Bidhaa
    public function bidhaa(){
        if(empty(Auth::user()->branch_id)){
            $data= Sbidhaa::all();            
            $branch = Branch::all();
            $product = Product::all();
            $categories = Category::all();
            return view('layouts.bidhaa',compact('branch','product','categories','data'));
        }
        else{
            $data= Sbidhaa::all();  
            $branch = Branch::all();
            $categories = Category::all();
            $product = Product::where('branch_id',Auth::user()->branch->id)->get();
            return view('layouts.bidhaa',compact('branch','product','categories','data'));
        }


    }
    //The function for the Dashboard
    public function dashboard(){
        if(empty(Auth::user()->branch_id)){            
            $branch = Branch::all();
            $product = Product::all(); 
            $payment = Payment::all();  
            $currentDate= date('Y-m-d');
            $user = User::all();
            $data= Sell::with('product')->select('product_id',DB::raw('sum(quantity) as count'))->groupBy('product_id')->orderBy('count','desc')->get();
            $p=Payment::sum('amount'); 
            $s = Order::where('status','IMEUZWA')->sum('total_amount'); 
            $sell=$p+$s; 
            $exp = Expense::sum('amount');
            $cash=$sell-$exp;

            $capital= Product::sum('capital');
            //notification
           
            $notification = Product::whereColumn('quantity', '<=', '70')
            ->join('sbidhaas', 'products.sbidhaa_id', '=', 'sbidhaas.id')
            ->select('sbidhaas.name', 'products.quantity')
            ->get()->map(function ($product) {
                $product->out_of_stock_at = Carbon::parse($product->out_of_stock_at)->format('Y-m-d H:i:s');
                return $product;
            });
            
            $outOfStockCount = $notification->count();
            session()->put('outOfStockCount', $outOfStockCount);

            Session::put('notification', $notification);
           
            //faid ya mauzo yote 
            $pprofit= Sell::select('profit')
                    ->where('sells.status','IMEUZWA')
                    ->sum(\DB::raw('sells.profit'));
        
            //faid ya mauzo ya siku  
           $faida=Sell::select('profit')
                    ->where('sells.status','IMEUZWA')->whereDate('sells.created_at',$currentDate)
                    ->sum(\DB::raw('sells.profit'));

            //madeni yote
            $madeni=Debt::sum('amount');
            $today= Order::select('total_amount')->whereDate('created_at',$currentDate)->where('status','IMEUZWA')->sum('total_amount');
            $t= Payment::select('amount')->whereDate('created_at',$currentDate)->sum('amount');
            $todaysales=$today+$t;
            
            $salesa = Order::selectRaw('YEAR(created_at) as year, MONTH(created_at) AS month, SUM(total_amount) AS total')
            ->where('status', 'IMEUZWA')
            ->groupBy('year', 'month')
            ->get();
        
        $salesb = Payment::selectRaw('YEAR(created_at) as year, MONTH(created_at) AS month, SUM(amount) AS totals')
            ->groupBy('year', 'month')
            ->get();
        
        $data = [];
        $labels = [];
        
        foreach ($salesa as $key => $sale) {
            $data[$key] = $sale->total + ($salesb[$key]->totals ?? 0);
            $labels[$key] = Carbon::createFromDate($sale->year, $sale->month)->format('M Y');
        }
        
               
        
            return view('layouts.dashboard',['labels' => $labels,'amounts' => $data],
            compact('user','branch','product','sell','capital','pprofit','data','todaysales','madeni','faida','cash','notification','outOfStockCount'));
        }
        else{
            $branch = Branch::all();
            $product = Product::all(); 
            $payment = Payment::all();  
            $currentDate= date('Y-m-d');
            $user = User::all();
            $data= Sell::with('product')->select('product_id',DB::raw('sum(quantity) as count'))->groupBy('product_id')->orderBy('count','desc')->get();
            $p=Payment::sum('amount'); 
            $s = Order::where('status','IMEUZWA')->sum('total_amount'); 
            $sell=$p+$s; 

            $exp = Expense::sum('amount');
            $cash=$sell-$exp;

            $capital= Product::sum('capital');
            //notification
           
            $notification = Product::where('quantity', '<=', 'threshold')
            ->with('sbidhaa')
            ->get();
                      
           
            //faid ya mauzo yote 
            $pprofit= Sell::select('profit')
                    ->where('sells.status','IMEUZWA')
                    ->sum(\DB::raw('sells.profit'));
        
            //faid ya mauzo ya siku  
           $faida=Sell::select('profit')
                    ->where('sells.status','IMEUZWA')->whereDate('sells.created_at',$currentDate)
                    ->sum(\DB::raw('sells.profit'));

            //madeni yote
            $madeni=Debt::sum('amount');
            $today= Order::select('total_amount')->whereDate('created_at',$currentDate)->where('status','IMEUZWA')->sum('total_amount');
            $t= Payment::select('amount')->whereDate('created_at',$currentDate)->sum('amount');
            $todaysales=$today+$t;
            $a = Sell::selectRaw('YEAR(created_at) as year,MONTH(created_at) AS month,SUM(total_amount) AS total')
                ->groupBy('year','month')
                ->get();
                $b = Payment::selectRaw('YEAR(created_at) as year,MONTH(created_at) AS month,SUM(amount) AS amount')
                ->groupBy('year','month')
                ->get();
                $sales=$a+$b;
         
                $data=[];
                $labels=[];
                 foreach($sales as $sale){
                    $data[]=$sale->amount;
                    $labels[]=Carbon::createFromDate($sale->year,$sale->month)->format('M Y');
                 }
               
        
            return view('layouts.dashboard',['labels' => $labels,'amounts' => $data],
            compact('user','branch','product','sell','capital','pprofit','data','todaysales','madeni','faida','cash','notification'));
        }


    }
    //The function for the empty
    public function empty(){
        return view('layouts.empty');
    }

    public function madeni(){
        $loan=Debt::where('status','debt')->with('order')->get();
        return view('layouts.madeni',compact('loan'));
    }

    //The function for the sajili bidhaa
    public function sbidhaa(){
        $data= Sbidhaa::all();
        return view('layouts.sajilbidhaa',compact('data'));
    }


    //The function for the historia ya mauzo
    public function historiamauzo(){

        $sells = Sell::all();
        return view('layouts.historiamauzo',compact('sells'));
    }
// function for matumizi
    public function matumizi()
    {
        $expenses=Expense::get();
        return view('layouts.matumizi',compact('expenses'));
    }
    //The function for the matawi
    public function matawi(Request $request){
        $branch = Branch::all();

        return view('layouts.matawi',compact('branch'));
    }
    //The function for the mauzo
    public function mauzo(){

        if(empty(Auth::user()->branch_id)){
            $branch = Branch::all();
            $product = Product::all();
            return view('layouts.mauzo',compact('product'));
        }
        else{
                $branch = Branch::all();
                $product = Product::where('branch_id',Auth::user()->branch->id)->get();
                return view('layouts.mauzo',compact('product'));
            }
    }

    public function cart(){

        return view ('layouts.cart');
    }

//The function for the mauzomuuzaji
public function mauzomuuzaji(Request $request)
{
    $group = [];
    $order = Order::select('id', 'user_id')
    ->groupBy('id', 'user_id')
    ->get();
    $sells = Sell::where('status', 'IMEUZWA')->get();

    foreach ($sells as $sell) {
        $group[$sell->order->id] = Sell::with(['product', 'order'])
            ->where('order_id', $sell->order->id)
            ->get()
            ->groupBy('order_id');
    }

    return view('layouts.mauzomuuzaji', compact('sells', 'order', 'group'));
}


    //The function for the reported
    public function printirisiti($id){


        return view('layouts.printirisiti');
    }
    public function report(Request $request)
    {
        $filter = $request->input('filter');
        $data = Sell::query();

        if (count($request->all()) > 0 && $filter === 'daily') {
            $data=Sell::with('product')
        ->join('products', 'sells.product_id', '=', 'products.id')
        ->select('sells.product_id', DB::raw('SUM(sells.quantity) as quantity'), DB::raw('SUM(sells.total_amount * sells.quantity) as amount'), DB::raw('SUM(sells.profit) as profit'))
        ->where('sells.status', 'IMEUZWA')
        ->whereDate('sells.created_at', today())
        ->groupBy('sells.product_id')
        ->get();

        $b=Payment::whereDate('created_at',today())->sum('amount');        
        $result = Sell::with('product')
        ->whereDate('created_at', today())
        ->where('status', 'IMEUZWA')           
        ->sum(\DB::raw('total_amount * quantity'));
        $pius = $result+$b;

        $sikup = Sell::with('product')
       ->whereDate('created_at', today())
       ->where('status', 'IMEUZWA')          
       ->sum('profit');

       return view('layouts.report',compact('data','pius','sikup'));
            //$expenses = $expenses->whereDate('created_at', today());
        } elseif (count($request->all()) > 0 && $filter === 'monthly') {
            $data=Sell::with('product')
            ->join('products', 'sells.product_id', '=', 'products.id')
            ->select('sells.product_id', DB::raw('SUM(sells.quantity) as quantity'), DB::raw('SUM(sells.total_amount * sells.quantity) as amount'), DB::raw('SUM(sells.profit) as profit'))
            ->where('sells.status', 'IMEUZWA')
            ->whereMonth('sells.created_at', today()->format('m'))
            ->groupBy('sells.product_id')
            ->get();
            $b=Payment::whereMonth('created_at',today()->format('m'))->sum('amount');
        
            $result = Sell::with('product')
            ->whereMonth('created_at', today()->format('m'))
            ->where('status', 'IMEUZWA')           
            ->sum(\DB::raw('total_amount * quantity'));
            $pius = $result+$b;

            $sikup = Sell::with('product')
           ->whereMonth('created_at', today()->format('m'))
           ->where('status', 'IMEUZWA')          
           ->sum('profit');
    
           return view('layouts.report',compact('data','pius','sikup'));
           // $expenses = $expenses->whereMonth('created_at', today()->format('m'));
        } elseif ($filter === 'custom') {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
            $data=Sell::with('product')
            ->join('products', 'sells.product_id', '=', 'products.id')
            ->select('sells.product_id', DB::raw('SUM(sells.quantity) as quantity'), DB::raw('SUM(sells.total_amount * sells.quantity) as amount'), DB::raw('SUM(sells.profit) as profit'))
            ->where('sells.status', 'IMEUZWA')
            ->whereBetween('sells.created_at', [$startDate." 00:00:00", $endDate." 23:59:59"])
            ->groupBy('sells.product_id')
            ->get();
            $b=Payment::whereBetween('created_at',array($startDate." 00:00:00",$endDate." 23::59:59"))->sum('amount');
        
            $result = Sell::with('product')
            ->whereBetween('created_at', [$startDate." 00:00:00", $endDate." 23:59:59"])
            ->where('status', 'IMEUZWA')           
            ->sum(\DB::raw('total_amount * quantity'));
            $pius = $result+$b;
           
            $sikup = Sell::with('product')
           ->whereBetween('created_at', [$startDate." 00:00:00", $endDate." 23:59:59"])
           ->where('status', 'IMEUZWA')          
           ->sum('profit');
    
           return view('layouts.report',compact('data','pius','sikup'));
          // $expenses = $expenses->whereBetween('created_at', [$startDate, $endDate . ' 23:59:59']);
            
        }else{
            $data=Sell::with('product')
            ->join('products', 'sells.product_id', '=', 'products.id')
            ->select('sells.product_id', DB::raw('SUM(sells.quantity) as quantity'), DB::raw('SUM(sells.total_amount * sells.quantity) as amount'), DB::raw('SUM(sells.profit) as profit'))
            ->where('sells.status', 'IMEUZWA')
            ->groupBy('sells.product_id')
            ->get();

        //$b=Payment::whereBetween('created_at',array($startDate." 00:00:00",$endDate." 23::59:59"))->sum('amount');
        
        $pius = Sell::with('product')
        ->where('status', 'IMEUZWA')
        ->sum(\DB::raw('total_amount * quantity'));
        // $a = $result->amount;
        // $pius=$a+$b;
        $sikup = Sell::with('product')
       ->where('status', 'IMEUZWA')
       ->sum('profit');
       return view('layouts.report',compact('data','pius','sikup'));
          
        }

    }
  

   public function generatePDF(Request $request)
   {
        // Validate the input
        // $request->validate([
        //     'from_date' => 'required|date',
        //     'to_date' => 'required|date|after_or_equal:from_date',
        //     'email' => 'required|email',
        // ]);

    
       $fromDate = $request->input('fromDate');
       $toDate   = $request->input('toDate');
       $emailTo   = $request->input('email');
   
       // $data = YourModel::whereBetween('date_column', [Carbon::parse($fromDate)->startOfDay(), Carbon::parse($toDate)->endOfDay()])->get();
     
       $query = Sell::with('product')->select('product_id',DB::raw('sum(quantity) as quantity'),
                DB::raw('sum(total_amount * quantity) as amount'),DB::raw('sum(profit) as profit'))
                ->groupBy('product_id')->where('status', 'IMEUZWA')         
                ->whereBetween('created_at',array($fromDate." 00:00:00",$toDate." 23::59:59"))->get();

        $b=Payment::whereBetween('created_at',array($fromDate." 00:00:00",$toDate." 23::59:59"))->sum('amount');

        $result = DB::table('sells')->select(DB::raw('SUM(total_amount * quantity) as amount'))
        ->whereBetween('created_at',array($fromDate." 00:00:00",$toDate." 23::59:59"))->where('status', 'IMEUZWA')->first();
        $a = $result->amount;
        $pius=$a+$b;

        $sikup = Sell::join('products', 'products.id', '=', 'sells.product_id')        
        ->where('sells.status', 'IMEUZWA')
        ->whereBetween('sells.created_at', [$fromDate." 00:00:00", $toDate." 23::59:59"])              
        ->sum(\DB::raw('sells.profit'));

       // Generate PDF using Dompdf
       $dompdf  = new Dompdf ();
       $html = View('pdf.reportpdf', compact('query','fromDate', 'toDate','pius','sikup','b'))->render();
       $dompdf->loadHtml($html);
      
   
       // Set paper size and orientation
       $dompdf->setPaper('A4', 'portrait');
   
       // Render the PDF
       $dompdf ->render();

       // Get the PDF content
       $pdfContent = $dompdf->output();

       if ($emailTo) {
        // Send the PDF as an email attachment
        $emailSubject = 'Sales Report';
        $emailBody = 'Please find attached the sales report for the specified product.';
        $attachmentFilename = 'sales_report.pdf';

        $attachment = new Swift_Attachment($pdfContent, $attachmentFilename, 'application/pdf');

        Mail::send([], [], function ($message) use ($emailTo, $emailSubject, $emailBody, $attachment) {
            $message->to($emailTo)
                ->subject($emailSubject)
                ->setBody($emailBody)
                ->attach($attachment);
        });
        Alert::success('success', 'Sales report PDF has been sent to ' . $emailTo);
        return redirect()->back();
    } 
    else {
        // Download the PDF
        $dompdf->stream('sales_report.pdf');

        return response($pdfContent)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="sales_report.pdf"');
    }
   }


public function reportPrint(Request $request){
    $fromDate = $request->input('fromDate');
        $toDate   = $request->input('toDate');
        $other    = $request->input('other');
        $role = Role::all();
        if(count($request->all()) > 0){
            $query = Sell::with('product')->select('product_id',DB::raw('sum(quantity) as quantity'),DB::raw('sum(total_amount) as amount'))->groupBy('product_id','created_at')->whereBetween('created_at',array($fromDate." 00:00:00",$toDate." 23::59:59"))->get();
            $pius =Sell::whereBetween('created_at',array($fromDate." 00:00:00",$toDate." 23::59:59"))->sum('total_amount');
            return view('layouts.reportPrint',compact('query','role','pius'));
        }
        else{
            $query = Sell::with('product')->select('product_id',DB::raw('sum(quantity) as quantity'),DB::raw('sum(total_amount) as amount'))->groupBy('product_id')->get();
            $pius =Sell::sum('total_amount');
            return view('layouts.reportPrint',compact('query','role','pius'));
        }
}

public function punguzo(){
    $shop =ShopInfo::all();
    return view ('layouts.punguzo',compact('shop'));
}

public function order(){
    $group = [];
    //$order = Order::groupBy('id')->get();
    $order = Order::select('id')
    ->groupBy('id')
    ->get();
    $sells = Sell::orderBy('order_id')->get();
    



foreach($sells as $sell){
        $group[$sell->order->id] = Sell::with(['product','order'])->where('order_id',$sell->order->id)->get()->groupBy('order_id');

}
$o = Order::where('status','HAIJAUZWA')->get();
        return view('layouts.order',compact('sells','order','group','o'));

}

public function editorder($id){
    $sell = Sell::where('order_id',$id)->get();
    $shop = ShopInfo::all();
    return view('layouts.editorder',compact('sell','shop'));
}



}
