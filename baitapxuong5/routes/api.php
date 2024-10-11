<?php

use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('projects', ProjectController::class);
Route::apiResource('projects.tasks', TaskController::class);


















// Route::get('/projects', [ProjectController::class, 'index']); // Lấy danh sách dự án
// Route::post('/projects', [ProjectController::class, 'store']); // Tạo dự án mới
// Route::get('/projects/{id}', [ProjectController::class, 'show']); // Xem chi tiết dự án
// Route::put('/projects/{id}', [ProjectController::class, 'update']); // Cập nhật dự án
// Route::delete('/projects/{id}', [ProjectController::class, 'destroy']); // Xóa dự án

// Route::get('/projects/{id}/tasks', [TaskController::class, 'index']); // Lấy danh sách nhiệm vụ
// Route::post('/projects/{id}/tasks', [TaskController::class, 'store']); // Tạo nhiệm vụ mới
// Route::get('/projects/{id}/tasks/{taskId}', [TaskController::class, 'show']); // Xem chi tiết nhiệm vụ
// Route::put('/projects/{id}/tasks/{taskId}', [TaskController::class, 'update']); // Cập nhật nhiệm vụ
// Route::delete('/projects/{id}/tasks/{taskId}', [TaskController::class, 'destroy']); // Xóa nhiệm vụ
