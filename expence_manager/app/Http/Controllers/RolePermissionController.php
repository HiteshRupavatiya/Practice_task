<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Traits\ResponseMessage;
use Illuminate\Support\Facades\Validator;
use App\Models\RolePermission;


class RolePermissionController extends Controller
{
    use ResponseMessage;

    //create role-permission
    public function create(Request $request){
        $validateRolePermission = Validator::make($request->all(), [
            'add_access'    => 'required|boolean|numeric|max:1',
            'edit_access'   => 'required|boolean|numeric|max:1',
            'view_access'   => 'required|boolean|numeric|max:1',
            'delete_access' => 'required|boolean|numeric|max:1',
            'role_id'       => 'required|exists:roles,id',
            'permission_id' => 'required|numeric|exists:permissions,id'
        ],
        [
            'boolean'       => 'this field in only access 1(active) or 0(deactive)',
        ]);

        if($validateRolePermission->fails()){
            return $this->ErrorResponse($validateRolePermission);
        }

        $rolepermission = RolePermission::create($request->only(
            'add_access',
            'edit_access',
            'view_access',
            'delete_access',
            'role_id',
            'permission_id'
        ));

        return $this->success('rolePermission Created Successfuly',$rolepermission);
    }

    //list role-permission with role 
    public function list(){
        $rolepermission = Role::with('role_permissions')->get();

        if(count($rolepermission ) > 0){
            return $this->success('list role With Pwrmission',$rolepermission);
        }
        return $this->DataNotFound();
    }

    //update role-permission
    public function update(Request $request,$id){
        $validateRolePermission = Validator::make($request->all(), [
            'add_access'    => 'boolean|numeric|max:1',
            'edit_access'   => 'boolean|numeric|max:1',
            'view_access'   => 'boolean|numeric|max:1',
            'delete_access' => 'boolean|numeric|max:1',
        ],
        [
            'boolean'       => 'this field in only access 1(active) or 0(deactive)',
        ]);

        if ($validateRolePermission->fails()) {
            return $this->ErrorResponse($validateRolePermission);
        }

        $role_permission = RolePermission::find($id);

        if ($role_permission) {
            $role_permission->update($request->only([
                'add_access',
                'edit_access',
                'view_access',
                'delete_access'
            ]));
            return $this->success('Role Permission Updated Successfuly');
        }
        return $this->DataNotFound();

    }

    //delete role-permission
    public function delete($id){
        $role_permission = RolePermission::find($id);

        if($role_permission){
            $role_permission->delete();
            return $this->success('Role-permission Deleted Successfuly');
        }
        return $this->DataNotFound();
    }

    //get role-permission by id

    public function get($id){
        $role_permission = RolePermission::with('role')->find($id);

        if($role_permission){
            return $this->success('List Role-permission with role',$role_permission);
        }
        return $this->DataNotFound();
    }



}
