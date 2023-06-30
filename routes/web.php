<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\BackEndController;
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
Route::get('/', [FrontEndController::class, 'showlogin'])->name('showlogin');

// Route definitions

############################ BACKEND ###############################

################ Branch  ################################

Route::post('login', [BackEndController::class, 'login'])->name('login');

// Don't touch this route; write your routes above this route

Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', [FrontEndController::class, 'dashboard'])->name('dashboard');
    Route::get('index', [FrontEndController::class, 'index']);

    Route::post('/send-sms', [BackEndController::class, 'sendSMS']);

    // Route for the product page
    Route::get('product', [FrontEndController::class, 'product'])->name('product');

    // Admin page
    Route::get('admin', [FrontEndController::class, 'admin'])->name('admin');

    // Route for bidhaa
    Route::get('bidhaa', [FrontEndController::class, 'bidhaa'])->name('bidhaa');

    // Route for the Dashboard
    Route::get('dashboard', [FrontEndController::class, 'dashboard'])->name('dashboard');

    // Route for mauzomuuzaji
    Route::get('mauzomuuzaji', [FrontEndController::class, 'mauzomuuzaji'])->name('mauzomuuzaji');

    // Route for empty
    Route::get('empty', [FrontEndController::class, 'empty'])->name('empty');

    // Route for madeni
    Route::get('madeni', [FrontEndController::class, 'madeni'])->name('madeni');

    // Router for historiamauzo
    Route::get('historiamauzo', [FrontEndController::class, 'historiamauzo']);

    // Route for logout

    // Route for matawi
    Route::get('matawi', [FrontEndController::class, 'matawi'])->name('matawi');

    // Route for mauzo
    Route::get('mauzo', [FrontEndController::class, 'mauzo'])->name('mauzo');

    // Route for printirisiti
    Route::get('printirisiti', [FrontEndController::class, 'printirisiti'])->name('printirisiti');

    // Route for report
    Route::get('report', [FrontEndController::class, 'report'])->name('report');

    // Route for risiti
    Route::get('risiti/{id}', [FrontEndController::class, 'risiti'])->name('risiti');

    // Route for sale_report
    Route::get('sale_report', [FrontEndController::class, 'report_report'])->name('sale_report');

    // Route for setting
    Route::get('setting', [FrontEndController::class, 'setting'])->name('setting');

    // Route for wateja
    Route::get('wateja', [FrontEndController::class, 'wateja'])->name('wateja');

    // Route for wauzaji
    Route::get('wauzaji', [FrontEndController::class, 'wauzaji'])->name('wauzaji');

    // Route for jukumu
    Route::get('jukumu', [FrontEndController::class, 'jukumu'])->name('jukumu');

    // Route for punguzo
    Route::get('punguzo', [FrontEndController::class, 'punguzo'])->name('punguzo');

    // Route for sajili bidhaa
    Route::get('sajilbidhaa', [FrontEndController::class, 'sbidhaa'])->name('sajilbidhaa');
    Route::post('sajilbidhaa/add', [BackEndController::class, 'createsbidhaa'])->name('sajilbidhaa.add');
    Route::post('sajilbidhaa/delete/{id}', [BackEndController::class, 'deletesbidhaa']);
    Route::post('sajilbidhaa/edit/{id}', [BackEndController::class, 'editsbidhaa']);

    // Route for welcome
    Route::get('cart', [FrontEndController::class, 'cart']);
    Route::post('deleteCart', [FrontEndController::class, 'deleteCart']);

    Route::get('report', [FrontEndController::class, 'report'])->name('report');
    Route::get('reportPrint', [FrontEndController::class, 'reportPrint'])->name('reportPrint');
    Route::post('exportPDF', [FrontEndController::class, 'exportPDF'])->name('exportPDF');
    Route::get('generatePDF', [FrontEndController::class, 'generatePDF'])->name('generatePDF');

    Route::get('logout', [BackEndController::class, 'logout'])->name('logout');

    Route::post('matawi/add', [BackEndController::class, 'createBranch'])->name('matawi.add');
    Route::delete('matawi/delete/{id}', [BackEndController::class, 'deleteBranch']);
    Route::post('matawi/edit/{id}', [BackEndController::class, 'editBranch']);

    Route::post('wauzaji/create', [BackEndController::class, 'createUser'])->name('wauzaji.create');
    Route::delete('wauzaji/delete/{id}', [BackEndController::class, 'deleteUser']);
    Route::post('wauzaji/edit/{id}', [BackEndController::class, 'editUser']);

    Route::post('bidhaa/create', [BackEndController::class, 'createProduct']);
    Route::post('bidhaa/delete/{id}', [BackEndController::class, 'deleteProduct']);
    Route::post('bidhaa/edit/{id}', [BackEndController::class, 'editProduct']);

    Route::post('upload', [BackEndController::class, 'upload']);

    Route::post('addToCart/{id}', [BackEndController::class, 'addToCart']);
    Route::post('deleteCart', [BackEndController::class, 'deleteCart']);
    Route::post('updateCart', [BackEndController::class, 'updateCart']);

    Route::post('mauzo/report', [BackEndController::class, 'report'])->name('mauzo.report');

    // Route::post('makePayment',[BackEndController::class,'makePayment'])->name('makePayment');
    Route::post('payment', [BackEndController::class, 'payment']);

    Route::post('checkout', [BackEndController::class, 'checkout']);
    Route::post('makeorder', [BackEndController::class, 'makeorder']);
    Route::get('viewPDF/{id}', [BackEndController::class, 'viewPDF'])->name('viewPDF');
    Route::get('previewPDF/{id}', [BackEndController::class, 'previewPDF'])->name('previewPDF');
    Route::post('addrole', [BackEndController::class, 'addrole']);
    Route::post('changepassword', [BackEndController::class, 'changepassword']);
    Route::post('changeinfo', [BackEndController::class, 'changeinfo']);
    Route::post('deleterole/{id}', [BackEndController::class, 'deleterole']);
    Route::get('editorder/{id}', [FrontEndController::class, 'editorder'])->name('editorder');
    Route::get('update/{id}', [BackEndController::class, 'update'])->name('updateorder');
    Route::post('editorders/{id}', [BackEndController::class, 'editorders'])->name('update.order');
    Route::post('updateShop/{id}', [BackEndController::class, 'updateShop'])->name('updateShop');

    Route::post('removeProduct/{id}', [BackEndController::class, 'removeProduct'])->name('remove');

    Route::post('delete/{id}', [BackEndController::class, 'delete'])->name('delete');

    // ------------------------ delete ------------------------- //

    Route::post('report', [BackEndController::class, 'search'])->name('search');

    Route::post('editRole/{id}', [BackEndController::class, 'editRole']);

    Route::get('sidebar', [BackEndController::class, 'sidebar']);
    Route::get('order', [FrontEndController::class, 'order'])->name('order');

    Route::get('/sajilibidhaa', [BackEndController::class, 'sEndSms'])->name('sEndSms');

    // Route for expenses
    Route::get('matumizi', [FrontEndController::class, 'matumizi'])->name('matumizi');
    Route::post('matumizi/create', [BackEndController::class, 'createMatumizi'])->name('createMatumizi');
    Route::post('matumizi/delete/{id}', [BackEndController::class, 'deletematumizi']);
    Route::post('matumizi/edit/{id}', [BackEndController::class, 'editMatumizi']);
    Route::get('/expenses/filter', [BackEndController::class, 'filter'])->name('expenses.filter');
});
