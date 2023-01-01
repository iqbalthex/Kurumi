<?php

use App\Controllers\HomeController;
use App\Controllers\TayoController;
use App\Models\Task;
use Kurumi\Http\Route;

/**
 * Pengaturan rute dan handler
 *
 * => rute, url yang dimasukkan pada browser
 *    contoh:
 *            - '/'         - '/page'
 *            - '/about'    - '/user'
 *
 * => handler, dapat berupa fungsi biasa,
 *    fungsi anonim atau controller
 *    contoh:
 *            - function(){}
 *            - [Controller::class, 'method']
 *
 * contoh lengkap:
 *                 - Route::get('/', [PageController::class, 'home'])
 *                 - Route::get('/about', [HomeController::class, 'about'])
 */


Route::get('/', [HomeController::class, 'home']);

Route::get('/hello', function () {
  var_dump(
    Task::Rasiel()->get()
  );
});

// jangan hapus kode di bawah ini!
Route::run();
