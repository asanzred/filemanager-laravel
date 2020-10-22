<?php

namespace Smallworldfs\Filemanager\Controllers;

use Exception;
use Illuminate\Routing\Controller;
use Smallworldfs\Filemanager\Libraries\Filemanager;

class FilemanagerController extends Controller
{
    public function __construct()
    {
        $this->middleware(config('filemanager.middlewares', ['web']));
        $this->middleware(config('filemanager.middleware_access', null));
    }

    public function getShow()
    {
        return view('filemanager::index');
    }

    public function getConnectors()
    {
        try {
            Filemanager::render(session('filemanager.public_path'));
        } catch (Exception $e) {
            if(config('app.debug')) {
                dd($e);
            }

            return abort(500);
        }
    }

    public function postConnectors()
    {
        try {
            Filemanager::render(session('filemanager.public_path'));
        } catch (Exception $e) {
            if(config('app.debug')) {
                dd($e);
            }

            return abort(500);
        }
    }
}
