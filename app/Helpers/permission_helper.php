<?php


function hasPermission($permission)
{
    $db = \Config\Database::connect();

    $userId = session()->get('user_id');

    if (!$userId) return false;

    $builder = $db->table('users');
    $builder->select('permissions.name');
    $builder->join('roles', 'roles.id = users.role_id');
    $builder->join('role_permissions', 'role_permissions.role_id = roles.id');
    $builder->join('permissions', 'permissions.id = role_permissions.permission_id');
    $builder->where('users.id', $userId);
    $builder->where('permissions.name', $permission);

    return $builder->countAllResults() > 0;
}