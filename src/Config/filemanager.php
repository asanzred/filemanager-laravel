<?php

return [
    'domain'            => 'your.domain.com',
    'prefix'            => 'file-manager',
    'public_path'       => '/filemanager/',
    // Activate if you need authentication to access filemanager
    //'middleware_auth'   => 'auth',
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
