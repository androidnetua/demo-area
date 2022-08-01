<?php

namespace App\Http\Controllers\Area;

use App\Http\Controllers\Controller;
use App\Models\Permission;

class PermissionsController extends Controller
{
    public function __invoke()
    {
        $permissions = Permission::orderBy('id')->get();

        foreach ($permissions as $permission){
            $permission->title = __('area.' . $permission->name);
        }

        return $permissions;
    }
}
