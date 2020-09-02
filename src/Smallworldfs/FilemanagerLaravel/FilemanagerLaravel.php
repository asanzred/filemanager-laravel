<?php

namespace Smallworldfs\FilemanagerLaravel;

class FilemanagerLaravel
{
    public static function Filemanager($extraConfig = null)
    {
        return new Filemanager($extraConfig);
    }

    public static function render(string $folder)
    {
        $f                = self::Filemanager();
        $f->connector_url = url('/') . '/filemanager/connectors';
        $f->setFileRoot($folder);
        $f->run();
    }
}