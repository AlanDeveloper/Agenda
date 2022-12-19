<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
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

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::get('/company', [CompanyController::class, 'index'])->name('company.index');
Route::get('/company/store', [CompanyController::class, 'store'])->name('company.store');
Route::post('/company/store', [CompanyController::class, 'save']);
Route::get('/company/update/{id}', [CompanyController::class, 'update'])->name('company.update');
Route::put('/company/update/{id}', [CompanyController::class, 'save']);
Route::delete('/company/delete/{id}', [CompanyController::class, 'delete'])->name('company.delete');

Route::get('/employee', [EmployeeController::class, 'index'])->name('employee.index');
Route::get('/employee/store', [EmployeeController::class, 'store'])->name('employee.store');
Route::post('/employee/store', [EmployeeController::class, 'save']);
Route::get('/employee/update/{id}', [EmployeeController::class, 'update'])->name('employee.update');
Route::put('/employee/update/{id}', [EmployeeController::class, 'save']);
Route::delete('/employee/delete/{id}', [EmployeeController::class, 'delete'])->name('employee.delete');
