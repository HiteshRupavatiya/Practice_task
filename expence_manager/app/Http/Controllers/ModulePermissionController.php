<?php

namespace App\Http\Controllers;

use App\Models\ModulePermission;
use App\Models\Permission;
use App\Traits\ResponseMessage;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ModulePermissionController extends Controller
{
    use ResponseMessage;

    public function list()
    {
        $module_permissions = ModulePermission::all();
        if (count($module_permissions)) {
            return $this->success('Module Permissions Fetched Successfuly', $module_permissions);
        } else {
            return $this->DataNotFound();
        }
    }

    public function create(Request $request)
    {
        $validate_module_permission = Validator::make($request->all(), [
            'add_access'    => 'required|boolean|numeric|max:1',
            'edit_access'   => 'required|boolean|numeric|max:1',
            'view_access'   => 'required|boolean|numeric|max:1',
            'delete_access' => 'required|boolean|numeric|max:1',
            'module_code'   => 'required|alpha_dash|exists:modules,code',
            'permission_id' => 'required|numeric|exists:permissions,id|unique:'
        ]);

        if ($validate_module_permission->fails()) {
            return $this->ErrorResponse($validate_module_permission);
        }

        $module_permission = ModulePermission::create($request->only(
            'add_access',
            'edit_access',
            'view_access',
            'delete_access',
            'module_code',
            'permission_id'
        ));

        return $this->success('Module Permission Created Successfuly', $module_permission);
    }

    public function update(Request $request, $id)
    {
        $validate_module_permission = Validator::make($request->all(), [
            'add_access'    => 'boolean|numeric|max:1',
            'edit_access'   => 'boolean|numeric|max:1',
            'view_access'   => 'boolean|numeric|max:1',
            'delete_access' => 'boolean|numeric|max:1',
        ]);

        if ($validate_module_permission->fails()) {
            return $this->ErrorResponse($validate_module_permission);
        }

        $module_permission = ModulePermission::find($id);

        if ($module_permission) {
            $module_permission->update($request->only([
                'add_access',
                'edit_access',
                'view_access',
                'delete_access'
            ]));
            return $this->success('Module Permission Updated Successfuly');
        }
        return $this->DataNotFound();
    }

    public function get($id)
    {
        $module_permission = ModulePermission::find($id);
        $module_permission->permission;
        if ($module_permission) {
            return $this->success('Module Permission Fetched Successfuly', $module_permission);
        }
        return $this->DataNotFound();
    }

    public function delete($id)
    {
        $module_permission = ModulePermission::find($id);
        if ($module_permission) {
            $module_permission->delete();
            return $this->success('Module Permission Deleted Successfuly');
        }
        return $this->DataNotFound();
    }
}
