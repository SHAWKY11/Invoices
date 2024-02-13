<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InvoiceDetailsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';
Route::resource('invoices', InvoiceController::class);
Route::resource('sections', SectionController::class);
Route::resource('products', ProductController::class);
Route::get('/section/{id}', [InvoiceController::class,'getproducts']);
Route::get('/edit_invoice/{id}', [InvoiceController::class,'edit'])->name('edit_invoice');
Route::get('/edit_status/{id}', [InvoiceController::class,'show'])->name('edit_status');
Route::get('/update_status/{id}', [InvoiceController::class,'Status_Update'])->name('update_status');
Route::get('InvoicesDetails/{id}', [InvoiceDetailsController::class,'edit']);
Route::post('delete', [InvoiceDetailsController::class,'destroy'])->name('delete');
Route::post('deletes', [InvoiceController::class,'destroy'])->name('deleteinvoice');
Route::get('/View_file/{invoice_number}/{file_name}', [InvoiceDetailsController::class,'open_file']);
Route::get('/download/{invoice_number}/{file_name}', [InvoiceDetailsController::class,'get_file']);
Route::get('/{page}', [AdminController::class,'index']);
