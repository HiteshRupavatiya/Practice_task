<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ResponseMessage;
use Illuminate\Support\Facades\Validator;
use App\Models\RolePermission;


class RolePermissionController extends Controller
{
    use ResponseMessage;

    public function create(Request $request){
        $validateRolePermission = Validator::make($request->all(), [
            'add_access'    => 'required|boolean|numeric|max:1',
            'edit_access'   => 'required|boolean|numeric|max:1',
            'view_access'   => 'required|boolean|numeric|max:1',
            'delete_access' => 'required|boolean|numeric|max:1',
            'role_id'       => 'required|exists:roles,id',
            'permission_id' => 'required|numeric|exists:permissions,id'
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

    public function list(){
        $rolepermission = RolePermission::with('role')->get();

        if(count($rolepermission ) > 0){
            return $this->success('list role With Pwrmission',$rolepermission);
        }
        return $this->DataNotFound();
    }


}
