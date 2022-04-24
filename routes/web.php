<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' => false,
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('admin', function () { return view('admin'); })->middleware(['auth','Role:admin']);

Route::get('/employee', [App\Http\Controllers\employeeController::class, 'index'])->name('employee.index')->middleware(['auth','Role:employee']);
Route::post('/employee/create', [App\Http\Controllers\employeeController::class, 'create'])->name('employee.create')->middleware(['auth','Role:employee']);
Route::post('/employee/edit/{id}', [App\Http\Controllers\employeeController::class, 'edit'])->name('employee.edit')->middleware(['auth','Role:employee']);
Route::delete('/employee/delete/{id}', [App\Http\Controllers\employeeController::class, 'delete'])->name('employee.delete')->middleware(['auth','Role:employee']);
Route::post('/employee/update/{id}', [App\Http\Controllers\employeeController::class, 'update'])->name('employee.update')->middleware(['auth','Role:employee']);

Route::get('/employee_to_many', [App\Http\Controllers\employeeToManyController::class, 'index'])->name('employee_to_many.index')->middleware(['auth','Role:employee']);
Route::post('/employee_to_many/member', [App\Http\Controllers\employeeToManyController::class, 'getMember'])->name('employee_to_many.member')->middleware(['auth','Role:employee']);
Route::post('/employee_to_many/create', [App\Http\Controllers\employeeToManyController::class, 'create'])->name('employee_to_many.create')->middleware(['auth','Role:employee']);
Route::post('/employee_to_many/edit/{id}', [App\Http\Controllers\employeeToManyController::class, 'edit'])->name('employee_to_many.edit')->middleware(['auth','Role:employee']);
Route::delete('/employee_to_many/delete/{id}', [App\Http\Controllers\employeeToManyController::class, 'delete'])->name('employee_to_many.delete')->middleware(['auth','Role:employee']);
Route::post('/employee_to_many/update/{id}', [App\Http\Controllers\employeeToManyController::class, 'update'])->name('employee_to_many.update')->middleware(['auth','Role:employee']);

Route::get('/employee_many_to_many', [App\Http\Controllers\employeeManyToManyController::class, 'index'])->name('employee_many_to_many.index')->middleware(['auth','Role:employee']);
Route::post('/employee_many_to_many/member', [App\Http\Controllers\employeeManyToManyController::class, 'getMember'])->name('employee_many_to_many.member')->middleware(['auth','Role:employee']);
Route::post('/employee_many_to_many/create', [App\Http\Controllers\employeeManyToManyController::class, 'create'])->name('employee_many_to_many.create')->middleware(['auth','Role:employee']);
Route::post('/employee_many_to_many/edit/{id}', [App\Http\Controllers\employeeManyToManyController::class, 'edit'])->name('employee_many_to_many.edit')->middleware(['auth','Role:employee']);
Route::delete('/employee_many_to_many/delete/{id}', [App\Http\Controllers\employeeManyToManyController::class, 'delete'])->name('employee_many_to_many.delete')->middleware(['auth','Role:employee']);
Route::post('/employee_many_to_many/update/{id}', [App\Http\Controllers\employeeManyToManyController::class, 'update'])->name('employee_many_to_many.update')->middleware(['auth','Role:employee']);

Route::get('/admin', [App\Http\Controllers\adminController::class, 'index'])->name('admin.index')->middleware(['auth','Role:admin']);
Route::post('/admin/create', [App\Http\Controllers\adminController::class, 'create'])->name('admin.create')->middleware(['auth','Role:admin']);
Route::post('/admin/edit/{id}', [App\Http\Controllers\adminController::class, 'edit'])->name('admin.edit')->middleware(['auth','Role:admin']);
Route::delete('/admin/delete/{id}', [App\Http\Controllers\adminController::class, 'delete'])->name('admin.delete')->middleware(['auth','Role:admin']);
Route::post('/admin/update/{id}', [App\Http\Controllers\adminController::class, 'update'])->name('admin.update')->middleware(['auth','Role:admin']);

Route::get('/admin_to_many', [App\Http\Controllers\adminToManyController::class, 'index'])->name('admin_to_many.index')->middleware(['auth','Role:admin']);
Route::post('/admin_to_many/member', [App\Http\Controllers\adminToManyController::class, 'getMember'])->name('admin_to_many.member')->middleware(['auth','Role:admin']);
Route::post('/admin_to_many/create', [App\Http\Controllers\adminToManyController::class, 'create'])->name('admin_to_many.create')->middleware(['auth','Role:admin']);
Route::post('/admin_to_many/edit/{id}', [App\Http\Controllers\adminToManyController::class, 'edit'])->name('admin_to_many.edit')->middleware(['auth','Role:admin']);
Route::delete('/admin_to_many/delete/{id}', [App\Http\Controllers\adminToManyController::class, 'delete'])->name('admin_to_many.delete')->middleware(['auth','Role:admin']);
Route::post('/admin_to_many/update/{id}', [App\Http\Controllers\adminToManyController::class, 'update'])->name('admin_to_many.update')->middleware(['auth','Role:admin']);

Route::get('/admin_many_to_many', [App\Http\Controllers\adminManyToManyController::class, 'index'])->name('admin_many_to_many.index')->middleware(['auth','Role:admin']);
Route::post('/admin_many_to_many/member', [App\Http\Controllers\adminManyToManyController::class, 'getMember'])->name('admin_many_to_many.member')->middleware(['auth','Role:admin']);
Route::post('/admin_many_to_many/create', [App\Http\Controllers\adminManyToManyController::class, 'create'])->name('admin_many_to_many.create')->middleware(['auth','Role:admin']);
Route::post('/admin_many_to_many/edit/{id}', [App\Http\Controllers\adminManyToManyController::class, 'edit'])->name('admin_many_to_many.edit')->middleware(['auth','Role:admin']);
Route::delete('/admin_many_to_many/delete/{id}', [App\Http\Controllers\adminManyToManyController::class, 'delete'])->name('admin_many_to_many.delete')->middleware(['auth','Role:admin']);
Route::post('/admin_many_to_many/update/{id}', [App\Http\Controllers\adminManyToManyController::class, 'update'])->name('admin_many_to_many.update')->middleware(['auth','Role:admin']);
