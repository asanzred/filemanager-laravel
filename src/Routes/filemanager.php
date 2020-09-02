<?php

use Illuminate\Http\Request;

Route::get('show',        'FilemanagerController@getShow')->name('filemanager.show');
Route::get('connectors',  'FilemanagerController@getConnectors')->name('filemanager.get.connector');
Route::post('connectors', 'FilemanagerController@postConnectors')->name('filemanager.post.connector');

Route::fallback(function(Request $request) {
    $file = config('filemanager_path') . $request->path();
    $file = str_replace('filemanagerv2', 'filemanager', $file);

    if(! file_exists($file))
        abort(404);

    $content  = file_get_contents($file);
    $mimetype = \GuzzleHttp\Psr7\mimetype_from_filename($file);

    return response(
        $content
    )->header('Content-Type', $mimetype);
})->name('filemanager.get.statics');