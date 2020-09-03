<?php

//AccessRoles => 'can:access-filemanager,\oneRole|otherRole|anotherRole'

return [
    'domain'            => 'your.domain.com',
    'prefix'            => 'file-manager',
    'middleware_auth'   => 'auth',
    'middleware_access' => 'can:access-filemanager,\oneRole'
];