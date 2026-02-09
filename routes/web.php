<?php

use App\Http\Controllers\GoogleDriveController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(GoogleDriveController::class)->group(function () {
    Route::get('file-upload', 'index');
    Route::post('upload-file', 'uploadFileToDrive')->name('upload-file');

    Route::get('drive/download/{id}', 'downloadFile')->name('drive.download');
    Route::get('drive/delete/{id}', 'deleteFile')->name('drive.delete');
});
