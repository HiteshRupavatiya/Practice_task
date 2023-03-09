<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Traits\ResponseMessage;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    use ResponseMessage;

    public function list()
    {
        $permissions = Module::with('permissions')->get();
        if (count($permissions) > 0) {
            return $this->success('Permissions Fetched Successfuly', $permissions);
        } else {
            return $this->DataNotFound();
        }
    }

    public function create(Request $request)
    {
        $validatePermission = Validator::make($request->all(), [
            'permission_name' => 'required|alpha_dash|min:4|max:20|unique:permissions,permission_name'
        ]);

        if ($validatePermission->fails()) {
            return $this->ErrorResponse($validatePermission);
        }

        $permission = Permission::create($request->only('permission_name'));

        return $this->success('Permission Created Successfuly', $permission);
    }

    public function update(Request $request, $id)
    {
        $validatePermission = Validator::make($request->all(), [
            'permission_name' => 'required|alpha|min:4|max:20|unique:permissions,permission_name'
        ]);

        if ($validatePermission->fails()) {
            return $this->ErrorResponse($validatePermission);
        }

        $permission = Permission::find($id);

        if ($permission) {
            $permission->update($request->only('permission_name'));
            return $this->success('Permission Updated Successfuly');
        }

        return $this->DataNotFound();
    }

    public function get($id)
    {
        $permission = Permission::find($id);
        if ($permission) {
            return $this->success('Permission Fetched Successfuly', $permission);
        }
        return $this->DataNotFound();
    }

    public function delete($id)
    {
        $permission = Permission::find($id);
        if ($permission) {
            $permission->delete();
            return $this->success('Permission Deleted Successfully');
        }
        return $this->DataNotFound();
    }
}
