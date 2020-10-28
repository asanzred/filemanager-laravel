<?php

namespace Smallworldfs\Filemanager\Controllers;

use Exception;
use Illuminate\Http\Request;
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

    public function getStatics(Request $request)
    {
        try {
            $file = config('filemanager.base_path') . $request->path();
            $file = str_replace(config('filemanager.prefix'), 'filemanager', $file);

            if(! file_exists($file))
                abort(404);

            $content  = file_get_contents($file);
            $mimetype = \GuzzleHttp\Psr7\mimetype_from_filename($file);

            return response($content)->header('Content-Type', $mimetype);
        } catch (Exception $e) {
            if(config('app.debug')) {
                dd($e);
            }

            return abort(500);
        }
    }
}
