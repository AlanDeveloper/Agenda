<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SolicitationController;
use App\Http\Controllers\TypeSolicitationController;
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
Route::get('/employee/{id}/schedule', [EmployeeController::class, 'schedule'])->name('employee.schedule');
Route::post('/employee/{id}/schedule', [EmployeeController::class, 'schedule_save'])->name('employee.schedule_save');
Route::post('/employee/store', [EmployeeController::class, 'save']);
Route::get('/employee/update/{id}', [EmployeeController::class, 'update'])->name('employee.update');
Route::put('/employee/update/{id}', [EmployeeController::class, 'save']);
Route::delete('/employee/delete/{id}', [EmployeeController::class, 'delete'])->name('employee.delete');

Route::get('/type_solicitation', [TypeSolicitationController::class, 'index'])->name('type_solicitation.index');
Route::get('/type_solicitation/store', [TypeSolicitationController::class, 'store'])->name('type_solicitation.store');
Route::post('/type_solicitation/store', [TypeSolicitationController::class, 'save']);
Route::get('/type_solicitation/update/{id}', [TypeSolicitationController::class, 'update'])->name('type_solicitation.update');
Route::put('/type_solicitation/update/{id}', [TypeSolicitationController::class, 'save']);
Route::delete('/type_solicitation/delete/{id}', [TypeSolicitationController::class, 'delete'])->name('type_solicitation.delete');

Route::get('/solicitation', [SolicitationController::class, 'index'])->name('solicitation.index');
Route::get('/solicitation/store', [SolicitationController::class, 'store'])->name('solicitation.store');
Route::post('/solicitation/store', [SolicitationController::class, 'save']);
Route::get('/solicitation/update/{id}', [SolicitationController::class, 'update'])->name('solicitation.update');
Route::put('/solicitation/update/{id}', [SolicitationController::class, 'save']);
Route::delete('/solicitation/delete/{id}', [SolicitationController::class, 'delete'])->name('solicitation.delete');
