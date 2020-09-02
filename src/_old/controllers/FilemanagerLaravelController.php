<?php namespace App\Http\Controllers;

use Smallworldfs\FilemanagerLaravel\FilemanagerLaravel;


class FilemanagerLaravelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:access-filemanager,\hr');
    }

    public function getShow()
    {
        return view('filemanager-laravel::filemanager.index');
    }

    public function getConnectors()
    {
        FilemanagerLaravel::render(session('filemanager_path'));
    }

    public function postConnectors()
    {
        FilemanagerLaravel::render(session('filemanager_path'));
    }
}