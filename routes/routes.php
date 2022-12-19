<?php

use App\Http\Controllers\DeductionController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// +++++++++++++++++ main routes

Route::get("/", function () {
    return view('home');
})->middleware(['auth', 'activeUser']);

Route::get("/home", function () {
    return view('home');
})->middleware(['auth', 'activeUser']);

Auth::routes();

Route::get("profile", [UserController::class, "profile.get"]);
// +++++++++++++++++ main routes

// +++++++++++++++++ users routes

Route::get("account", [UserController::class, "accountShow"]);

Route::post('account/write', [UserController::class, 'accountWrite']);

Route::get("users", [UserController::class, "index"]);

Route::get("users/getData", [UserController::class, "getData"]);

Route::post("user/write", [UserController::class, "write"]);

Route::delete("user/{user}", [UserController::class, "delete"]);

Route::get("user/updateStatus/{user}", [UserController::class, "updateStatus"]);

Route::get('users/export/excel', [UserController::class, 'exportExcel']);

Route::post('user/permissions/{user}', [UserController::class, 'updatePermissions']);

Route::get('user/permissions/{user}', [UserController::class, 'getPermissions']);

// +++++++++++++++++ users routes

// +++++++++++++++++ employees routes

Route::get("employees", [EmployeeController::class, "index"]);

Route::get("employees/getData", [EmployeeController::class, "getData"]);

Route::post("employee/write", [EmployeeController::class, "write"]);

Route::delete("employee/{user}", [EmployeeController::class, "delete"]);

Route::get('employees/export/excel', [EmployeeController::class, 'exportExcel']);

// +++++++++++++++++ employees routes

// +++++++++++++++++ expenses routes

Route::get("expenses", [ExpenseController::class, "index"]);

Route::get("expenses/getData", [ExpenseController::class, "getData"]);

Route::post("expense/write", [ExpenseController::class, "write"]);

Route::delete("expense/{user}", [ExpenseController::class, "delete"]);

Route::get('expenses/export/excel/{employee}', [ExpenseController::class, 'exportExcel']);

// +++++++++++++++++ expenses routes

// +++++++++++++++++ deductions routes

Route::get("deductions", [DeductionController::class, "index"]);

Route::get("deductions/getData", [DeductionController::class, "getData"]);

Route::post("deduction/write", [DeductionController::class, "write"]);

Route::delete("deduction/{user}", [DeductionController::class, "delete"]);

Route::get('deductions/export/excel/{employee}', [DeductionController::class, 'exportExcel']);

// +++++++++++++++++ deductions routes

// +++++++++++++++++ reports routes

Route::get('reports', [ReportController::class, 'index']);

Route::get("reports/getData", [ReportController::class, "getData"]);

Route::post('export/pdf', [ReportController::class, 'exportPdf']);

Route::post('export/excel', [ReportController::class, 'exportExcel']);

// +++++++++++++++++ deductions routes

// +++++++++++++++++ media login
Route::get('login/google', [GoogleController::class, 'redirectToGoogle']);

Route::get('login/google/callback', [GoogleController::class, 'handleGoogleCallback']);
// +++++++++++++++++ media login
