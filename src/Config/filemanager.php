<?php

//AccessRoles => 'can:access-filemanager,\oneRole,otherRole,anotherRole'

return [
    'domain'            => 'your.domain.com',
    'middleware_auth'   => 'auth',
    'middleware_access' => 'can:access-filemanager,\oneRole'
];