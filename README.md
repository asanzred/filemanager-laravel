# FileManager for Laravel

This package is based on: http://github.com/simogeo/Filemanager.git , and we have made modifications to encapsulate it, to get a single installable in our projects.

Once you have installed this package, you will have also all dependencies necessaries to work.

## Installation

If you have composer installed globally, your need run:
```shell
composer require "smallworldfs/filemanager-laravel"
```

Otherwise, you must have a composer.phar file in your base dir of your project to run:
```shell
php composer.phar require "smallworldfs/filemanager-laravel"
```

## Register Filemanager Provider
First, you need append the package provider to laravel providers array in the config/app.php file.
```shell
'providers' => [
    // ...
    Smallworldfs\Filemanager\Providers\FilemanagerProvider::class,
];
```

## Configuration

This package, auto load/register "Gates Policies", "Routes", "Statics"... and you not need anything to work in your project.

But... you must configure the config vars to work successfully and customizing with your environment.

Running this command, the package copy (filemanager.php base config file) to laravel config dir, and you can edit this file.
```shell
php artisan vendor:publish --provider="Smallworldfs\Filemanager\Providers\FilemanagerProvider"
```

*Only one file, it's great!!*

### FileManager Config File

This is the config file, you can see a comment with an example of roles to limit user access to the filemanager.

```php
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
```

To work with roles, you need to create roles table in your database with the next structure:

```
UserTable
 - id
 - name
 - email
 - ... (another fileds you need)
RolesTable
 - id
 - name*
 - ... (another fileds you need)

UserRolesTable
 - id
 - user_id
 - role_id


* (role_name is necessary for limit access in the filemanager config file)
```

Then, you can access to the user role with Eloquent relations on the model:

```php
> UserModel::class

public function roles()
{
    return $this->belongsToMany(RoleModel::class);
}

public function hasAnyRole(array $roles)
{
    return null !== $this->roles()->whereIn('name', $roles)->first();
}

public function hasRole($role)
{
    return null !== $this->roles()->where('name', $role)->first();
}

> RoleModel::class

public function users()
{
  return $this->belongsToMany(UserModel::class);
}
```

And to activate user access, you need configure the middleware attributes of the config file:

```php
// Activate also, if you need limit user access with roles
//      AccessRoles Example => 'can:access-filemanager,\admin|oneRole|otherRole|anotherRole'
'middleware_access' => 'can:access-filemanager,\oneRole',
// Configure to work with middleware_access, permit access to the first role of user
'roles_path'        => [
    //'admin'       => '/filemanager/', Equals that public_path is the base dir to other roles
    'oneRole'       => '/filemanager/oneRole',
    'otherRole'     => '/filemanager/otherRole',
    'anotherRole'   => '/filemanager/anotherRole',
],
```

**Note1: If you only need one user access, create only admin role**

**Note2: If an user have multiple roles, only work's with first user role**

**Note3: If you not specify public_path, it will use /filemanager/**

**Note4: If you not specify roles_path, it will use public_path**