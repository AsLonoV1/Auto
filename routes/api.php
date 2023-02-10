  <?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


      Route::get('userList',[UserController::class,'List'])->name('userList');
       
      Route::get('userShow',[UserController::class,'Show'])->name('userShow');

      Route::post('userCreate',[UserController::class,'Create'])->name('userCreate');

      Route::post('userUpdate',[UserController::class,'Update'])->name('userUpdate');

      Route::get('userDelete',[UserController::class,'Delete'])->name('userDelete');
      



      Route::get('categoryList',[CategoryController::class,'List'])->name('categoryList');
       
      Route::get('categoryShow',[CategoryController::class,'Show'])->name('categoryShow');

      Route::post('categoryCreate',[CategoryController::class,'Create'])->name('categoryCreate');

      Route::post('categoryUpdate',[CategoryController::class,'Update'])->name('categoryUpdate');

      Route::get('categoryDelete',[CategoryController::class,'Delete'])->name('categoryDelete');


      

      Route::get('productList',[ProductController::class,'List'])->name('productList');
       
      Route::get('productShow',[ProductController::class,'Show'])->name('productShow');

      Route::post('productCreate',[ProductController::class,'Create'])->name('productCreate');

      Route::post('productUpdate',[ProductController::class,'Update'])->name('productUpdate');

      Route::get('productDelete',[ProductController::class,'Delete'])->name('productDelete');


     
  















