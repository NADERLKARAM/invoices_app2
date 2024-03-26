<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\InvoiceAttachmentsController;
use App\Http\Controllers\InvoiceAchiveController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Invoices_Report;
use App\Http\Controllers\Customers_Report;


Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('auth.login');
});




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::resource('invoices', InvoicesController::class);
Route::get('/edit_invoice/{id}', [InvoicesController::class, 'edit']);

Route::get('/section/{id}', [InvoicesController::class, 'getproducts']);


Route::get('/invoices/{invoice}', [InvoicesDetailsController::class,'show'])->name('invoices.show');
Route::get('View_file/{invoice_number}/{file_name}', [InvoicesDetailsController::class,'open_file']);
Route::get('download/{invoice_number}/{file_name}', [InvoicesDetailsController::class,'get_file']);
Route::post('delete_file', [InvoicesDetailsController::class,'destroy'])->name('delete_file');


Route::get('/sections', [SectionsController::class, 'index']);
Route::post('/', [SectionsController::class, 'store'])->name("sections.store");
Route::put('/sections/update', [SectionsController::class, 'update'])->name("sections.update");
Route::delete('/sections/destroy', [SectionsController::class, 'destroy'])->name("sections.destroy");





Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::put('/products', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products', [ProductController::class, 'destroy'])->name('products.destroy');



Route::resource('InvoiceAttachments', InvoiceAttachmentsController::class);





Route::get('/Status_show/{id}', [InvoicesController::class, 'show'])->name('Status_show');
Route::post('/Status_Update/{id}', [InvoicesController::class, 'Status_Update'])->name('Status_Update');



Route::get('/Invoice_Paid', [InvoicesController::class, 'Invoice_Paid']);
Route::get('/InvoiceUnPaid', [InvoicesController::class, 'Invoice_UnPaid']);
Route::get('/InvoicePartial', [InvoicesController::class, 'InvoicePartial']);

Route::get('/Print_invoice/{id}', [InvoicesController::class, 'Print_invoice']);





Route::resource('Archive', InvoiceAchiveController::class);




Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});



Route::get('invoices_report', [Invoices_Report::class,'index']);

Route::post('Search_invoices', [Invoices_Report::class,'Search_invoices']);


Route::get('customers_report', [Customers_Report::class,'index']);

Route::post('Search_customers', [Customers_Report::class,'Search_customers']);
