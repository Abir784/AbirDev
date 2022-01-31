<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [MyController::class, 'welcome']);




Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

//user
Route::get('/user/delete/{user_id}', [HomeController::class,'delete'])->name('del');

//category
Route::get('/category',[CategoryController::class,'category'])->name('cat');
Route::post('/category/insert',[CategoryController::class,'insert'])->name('insert');
Route::get('/category/delete/{category_id}',[CategoryController::class, 'delete'])->name('delete');
Route::get('/category/restore/{category_id}',[CategoryController::class, 'restore'])->name('restore');
Route::get('/category/force_delete/{category_id}',[CategoryController::class, 'force_delete'])->name('force_delete');
Route::get('/category/edit/{category_id}',[CategoryController::class, 'edit'])->name('edit');
Route::post('/category/update',[CategoryController::class,'update'])->name('update');
Route::post('/category/markdel',[CategoryController::class,'markdel'])->name('markdel');
Route::get('/category/markrestore/{category_id}',[CategoryController::class,'markrestore'])->name('markrestore');

//subcategory
Route::get('/subcategory',[SubcategoryController::class,'subcategory'])->name('subcategory');
Route::post('/subcategory/insert',[SubcategoryController::class,'insert'])->name('subcategory.insert');
Route::get('/subcategory/delete/{subcategory_id}',[SubcategoryController::class,'delete'])->name('subcategory.delete');
Route::get('/subcategory/edit/{subcategory_id}',[SubcategoryController::class,'edit'])->name('subcategory.edit');
Route::post('/subcategory/update',[SubcategoryController::class,'update'])->name('subcategory.update');




