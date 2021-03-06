<?php

use App\Models\Note;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/notes', function () {
        return view('notes.index', [
            'notes' => Note::paginate(),
        ]);
    })->name('notes.index');

    Route::get('/notes/{note:slug}', function (Note $note) {
        return view('notes.edit', [
            'note' => $note,
        ]);
    })->name('notes.edit');
});

require __DIR__.'/auth.php';
