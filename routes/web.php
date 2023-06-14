<?php

use Illuminate\Support\Facades\Route;
use App\Http\controllers\FrontEndController;
use App\Http\controllers\BackendController;


use App\Mail\MyTestEmail;
use Illuminate\Support\Facades\Mail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[FrontEndController::class,'showlogin'])->name('showlogin');



//route

############################ BACKEND ###############################

################ Branch  ################################


Route::post('login',[BackEndController::class,'login']);


//dont touch from this route  write your routes above this route

Route::group(['middleware' => 'auth'],function(){
   
    Route::get('dashboard',[FrontEndController::class,'dashboard'])->name('dashboard');
    
    Route::get('index',[FrontEndController::class,'index']);

    Route::post('/send-sms', [BackEndController::class, 'sendSMS']);

    // this is the route for the product page
    Route::get('product',[FrontEndController::class,'product'])->name('product');

    //this is the admin page
    Route::get('admin',[FrontEndController::class,'admin'])->name('admin');

    //this is the route for the bidhaa
    Route::get('bidhaa',[FrontEndController::class,'bidhaa'])->name('bidhaa');

    //this is the route for the Dashboard
    Route::get('dashboard',[FrontEndController::class,'dashboard'])->name('dashboard');

    //this is the route of the mauzomuuzaji
    Route::get('mauzomuuzaji',[FrontEndController::class, 'mauzomuuzaji'])->name('mauzomuuzaji');

    //this is the route for the empty
    Route::get('empty',[FrontEndController::class,'empty'])->name('empty');

    //this is the route for the madeni
    Route::get('madeni',[FrontEndController::class,'madeni'])->name('madeni');

    //this is the router for the historiamauzo
    Route::get('historiamauzo',[FrontEndController::class,'historiamauzo']);

   


    //this is the route for logout

    //this is the route for the matawi
    Route::get('matawi',[FrontEndController::class,'matawi'])->name('matawi');

    //this is the route for the mauzo
    Route::get('mauzo',[FrontEndController::class,'mauzo'])->name('mauzo');

    //this is the route for the printirisiti
    Route::get('printirisiti',[FrontEndController::class,'printirisiti'])->name('printirisiti');

    //this is the route for the report
    Route::get('report',[FrontEndController::class,'report'])->name('report');

    //this is the route for the risiti
    Route::get('risiti/{id}',[FrontEndController::class,'risiti'])->name('risiti');

    //this is the route for the sale_report
    Route::get('sale_report',[FrontEndController::class,'report_report'])->name('sale_report');

    //this is the route for the setting
    Route::get('setting',[FrontEndController::class,'setting'])->name('setting');

    //this is the route for the wateja
    Route::get('wateja',[FrontEndController::class,'wateja'])->name('wateja');

    //this is the route for the wauzaji
    Route::get('wauzaji',[FrontEndController::class,'wauzaji'])->name('wauzaji');

    //this is the route for the jukumu
    Route::get('jukumu',[FrontEndController::class,'jukumu'])->name('jukumu');

    //this is the route for the punguzo
    Route::get('punguzo',[FrontEndController::class,'punguzo'])->name('punguzo');

    //this is the route for the sajili bidhaa
    Route::get('sajilbidhaa',[FrontEndController::class,'sbidhaa'])->name('sajilbidhaa');
    Route::post('sajilbidhaa/add',[BackendController::class,'createsbidhaa'])->name('sajilbidhaa.add');
    Route::post('sajilbidhaa/delete/{id}',[BackendController::class,'deletesbidhaa']);
    Route::post('sajilbidhaa/edit/{id}',[BackendController::class,'editsbidhaa']);


    //this is the route for the welcome
    Route::get('cart',[FrontEndController::class,'cart']);
    Route::post('deleteCart',[FrontEndController::class,'deleteCart']);

    Route::get('report',[FrontEndController::class,'report'])->name('report');
    Route::get('reportPrint',[FrontEndController::class,'reportPrint'])->name('reportPrint');
    Route::post('exportPDF',[FrontEndController::class,'exportPDF'])->name('exportPDF');
    Route::get('generatePDF',[FrontEndController::class,'generatePDF'])->name('generatePDF');
 
 


    Route::get('logout',[BackendController::class,'logout'])->name('logout');




    Route::post('matawi/add',[BackendController::class,'createBranch'])->name('matawi.add');
    Route::delete('matawi/delete/{id}',[BackendController::class,'deleteBranch']);
    Route::post('matawi/edit/{id}',[BackendController::class,'editBranch']);

 

    Route::post('wauzaji/create',[BackendController::class,'createUser'])->name('wauzaji.create');
    Route::delete('wauzaji/delete/{id}',[BackendController::class,'deleteUser']);
    Route::post('wauzaji/edit/{id}',[BackendController::class,'editUser']);

    Route::post('bidhaa/create',[BackendController::class,'createProduct']);
    Route::post('bidhaa/delete/{id}',[BackendController::class,'deleteProduct']);
    Route::post('bidhaa/edit/{id}',[BackendController::class,'editProduct']);

    Route::post('upload',[BackendController::class,'upload']);


    Route::post('addToCart/{id}',[BackendController::class,'addToCart']);
    Route::post('deleteCart',[BackendController::class,'deleteCart']);
    Route::post('updateCart',[BackendController::class,'updateCart']);

    Route::post('mauzo/report',[BackendController::class,'report'])->name('mauzo.report');
    
    // Route::post('makePayment',[BackendController::class,'makePayment'])->name('makePayment');
    Route::post('payment',[BackendController::class,'payment']);
 
    
    Route::post('checkout',[BackendController::class,'checkout']);
    Route::post('makeorder',[BackendController::class,'makeorder']);
    Route::get('viewPDF/{id}',[BackendController::class,'viewPDF'])->name('viewPDF');
    Route::get('previewPDF/{id}',[BackendController::class,'previewPDF'])->name('previewPDF');
    Route::post('addrole', [BackendController::class, 'addrole']);
    Route::post('changepassword', [BackendController::class, 'changepassword']);
    Route::post('changeinfo', [BackendController::class, 'changeinfo']);
    Route::post('deleterole/{id}', [BackendController::class, 'deleterole']);
    Route::get('editorder/{id}',[FrontEndController::class, 'editorder'])->name('editorder');
    Route::get('update/{id}',[BackEndController::class, 'update'])->name('updateorder');
    Route::post('editorders/{id}',[BackEndController::class, 'editorders'])->name('update.order');
    Route::post('updateShop/{id}',[BackEndController::class, 'updateShop'])->name('updateShop');

    Route::post('deleterole/{id}', [BackendController::class, 'deleterole']);
    Route::post('removeProduct/{id}', [BackendController::class, 'removeProduct'])->name('remove');

   // Route::post('report',[BackendController::class, 'report'])->name('report');
    Route::get('delete/{id}',[BackendController::class, 'delete'])->name('delete');
// ------------------------ delete ------------------------- //


Route::post('report',[BackendController::class, 'search'])->name('search');

Route::post('editRole/{id}',[BackendController::class, 'editRole']);

Route::get('sidebar',[BackendController::class, 'sidebar']);
Route::get('order',[FrontEndController::class, 'order'])->name('order');

Route::get('/sajilibidhaa', [BackendController::class,'sendSms'])->name('sendSms');


 // this is the router for the expences
 Route::get('matumizi',[FrontEndController::class,'matumizi'])->name('matumizi');
Route::post('matumizi/create',[BackendController::class,'createMatumizi'])->name('createMatumizi');
Route::post('matumizi/delete/{id}',[BackendController::class,'deletematumizi']);
Route::post('matumizi/edit/{id}',[BackendController::class,'editMatumizi']);
Route::get('/expenses/filter', [BackendController::class, 'filter'])->name('expenses.filter');
});



