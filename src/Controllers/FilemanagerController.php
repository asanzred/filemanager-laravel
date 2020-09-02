<?php

namespace Smallworldfs\Filemanager\Controllers;

use Illuminate\Routing\Controller;
use Smallworldfs\Filemanager\Libraries\FilemanagerLaravel;

class FilemanagerController extends Controller
{
    public function __construct()
    {
        $this->middleware(config('filemanager.middleware_auth', 'auth'));
        $this->middleware(config('filemanager.middleware_access', null));
    }

    public function getShow()
    {
        return view('filemanager::index');
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