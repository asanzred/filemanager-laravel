<?php

return [
    // Domain of your project or one domain custom for filemanager
    'domain'            => env('APP_URL', 'your.domain.com'),
    // Prefix for url group
    'prefix'            => 'file-manager',
    // Folder to store files, normally behind of laravel public dir
    // Always folder tree must be start with /filemanager/userfiles/
    // Example custom folder: /filemanager/userfiles/myfolder
    'public_path'       => '/filemanager/userfiles/',
    // Disable your authentication middleware if needs
    'middlewares'       => ['web', 'auth'],
    // Activate also, if you need limit user access with roles
    //      AccessRoles Example => 'can:access-filemanager,\admin|oneRole|otherRole|anotherRole'
    //'middleware_access' => 'can:access-filemanager,\oneRole',
    // Configure to work with middleware_access, permit access to the first role of user
    //'roles_path'        => [
    //    //'admin'       => '/filemanager/', Equals that public_path is the base dir to other roles
    //    'oneRole'       => '/filemanager/oneRole',
    //    'otherRole'     => '/filemanager/otherRole',
    //    'anotherRole'   => '/filemanager/anotherRole',
    //],
];
