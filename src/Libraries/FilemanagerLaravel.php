<?php

namespace Smallworldfs\Filemanager\Libraries;

use Exception;

class FilemanagerLaravel
{
    public static function render(string $folder)
    {
        try {
            $extraConfig = null;
            $f           = new Filemanager($extraConfig);
            $f->connector_url = route('filemanager.get.connector');
            $f->setFileRoot($folder);
            $f->run();
        } catch (Exception $e) {
            if(config('app.debug')) {
                dd($e);
            }

            return abort(500);
        }
    }
}