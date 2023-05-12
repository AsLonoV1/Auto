  <?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::post('login', [AuthController::class, 'login']);
Route::post('refreshToken', [AuthController::class, 'refreshToken']);


Route::group(['middleware' => ["auth:api"]], function(){

  Route::prefix('user')->controller(UserController::class)->group(function(){
      Route::get('list','List')->name('userList');
      Route::get('show','Show')->name('userShow');
      Route::post('create','Create')->name('userCreate');
      Route::post('update','Update')->name('userUpdate');
      Route::get('delete','Delete')->name('userDelete');
  });
      
  Route::prefix('category')->controller(CategoryController::class)->group(function(){
      Route::get('list','List')->name('categoryList');
      Route::get('show','Show')->name('categoryShow');
      Route::post('create','Create')->name('categoryCreate');
      Route::post('update','Update')->name('categoryUpdate');
      Route::get('delete','Delete')->name('categoryDelete');
  });
  
  Route::prefix('product')->controller(ProductController::class)->group(function(){
      Route::get('list','List')->name('productList');
      Route::get('show','Show')->name('productShow');
      Route::post('create','Create')->name('productCreate');
      Route::post('update','Update')->name('productUpdate');
      Route::get('delete','Delete')->name('productDelete');
  });
      
  Route::controller(OrderController::class)->group(function(){
      Route::get('basket','basket')->name('basket');
      Route::get('abort','abort')->name('abort');
      Route::get('order','order')->name('order');
  });
       
      Route::get('logOut',[AuthController::class,'logOut'])->name('logOut');
      
});