<?php


namespace Smallworldfs\Filemanager\Contracts;


interface UserFilemanager
{
    public function hasAnyRole(array $roles);
    public function hasRole(string $role);
}