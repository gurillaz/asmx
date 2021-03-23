<?php

use App\Category;
use App\Client;
use App\DocumentType;
use App\Http\Controllers\OfferController;
use App\Product;
use App\Profacture;
use App\Supplier;
use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

use Illuminate\Support\Str;


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


// DO NOT CHANGE
// After logging out user is redirected at '/' or home, this redirects to /dashboard
// where it requires to be authenticated to countine and redirects to login page if not authenticated
Route::get('/', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('home');



//Authenticated
Route::middleware(['auth', 'auth'])->group(function () {

    // DO NOT CHANGE
    // Toggle session PRIVATE OR PUBLIC
    //TODO crate a new controller
    Route::post('/session/toggle', function (Request $request) {
        if ($request->session()->get('public') == true) {
            $request->session()->put('public', false);
        } else {
            $request->session()->put('public', true);
        }

        return back();
    });
    // ->middleware(['auth', 'verified'])->name('dashboard');

    // DO NOT CHANGE
    // After logging in user is redirected at 'dashboard' via AuthServiceProvider const HOME.
    // If deleted user is redirectet to 404
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    });
    // ->middleware(['auth', 'verified'])->name('dashboard');


    Route::get('/offer/last', 'OfferController@show_last_offer');
    Route::get('/offer/today', 'OfferController@show_today_offers');
    Route::resource('/offer', 'OfferController');
    Route::get('/offer/print/{offer}', 'OfferController@print');

    Route::resource('/product/category', 'CategoryController');
    Route::resource('/product', 'ProductController');

    Route::resource('/client', 'ClientController');
    Route::resource('/supplier', 'SupplierController');
    Route::resource('/brand', 'BrandController');
    Route::resource('/subject', 'SubjectController');
    Route::resource('/document-type', 'DocumentTypeController');
    Route::get('/product/import', 'ProductController@import_create');
    Route::post('/product/import_store', 'ProductController@import_store');
});





//Test can delete
Route::get('/document/crud', function () {
    //TODO check for session private or public
    $document_types = DocumentType::all();
    return Inertia::render('DocumentCrud', ['document_types' => $document_types]);
})->middleware(['auth', 'c'])->name('documentcrud');

//Test can delete


Route::get('/session', function (Request $request) {

    $profacture = Profacture::where('id',10007)->first();
    $products = Product::all();
    $random_product=$products->random();
    $profacture->products()->attach($random_product,[
        'product_order_no'=>$profacture->products->count()+1,
         'custom_product_name'=>'Custom name'.$random_product->id,
          'quantity'=>10,
          'price' =>10.00,
           'discount' =>0.1
    ]);

    dd($profacture);

});







Auth::routes();
