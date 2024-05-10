<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Middleware\MustBeAdmin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return 'Make The Page';
});
// Route::get('/tokens', function () {
//     $credentials = [
//         'email' => 'admin@admin.com',
//         'password' => 'password',
//     ];
//     if (!Auth::attempt($credentials)) {
//         $user = new User();

//         $user->name = 'Admin';
//         $user->email = $credentials['email'];
//         $user->password = Hash::make($credentials['password']);
//         $user->save();
//     }
//     $user = Auth::user();
//     $adminToken = $user->createToken('admin-token', ['create', 'update', 'delete']);
//     $updateToken = $user->createToken('update-token', ['create', 'update']);
//     $basicToken = $user->createToken('basic-token', ['login']);
//     return [
//         'admin' => $adminToken->plainTextToken,
//         'update' => $updateToken->plainTextToken,
//         'basic' => $basicToken->plainTextToken,
//     ];
// });


Route::resource('admin/books', AdminPostController::class)->except('show')->middleware('can:admin');
Route::get('/admin/categories/create', [AdminPostController::class, 'createCategory']);
Route::post('/admin/categories', [AdminPostController::class,'storeCategory']);
Route::get('/admin/subcategories/create', [AdminPostController::class, 'createSubcategory']);
Route::post('/admin/subcategories', [AdminPostController::class,'storeSubcategory']);;
