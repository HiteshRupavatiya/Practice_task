<?php

namespace App\Http\Controllers;
use App\Traits\ResponseMessage;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    use ResponseMessage;

    //List Role
    public function list(){
        $roles = Role::all();

        if(count($roles) > 0){
            return $this->success('List Roles',$roles);
        }
        else {
            return $this->DataNotFound();
        }
    }

    //create Role
    public function create(Request $request){
        $validatedata = Validator::make($request->all(), [
            'role_name'              => 'required|unique:roles,role_name|max:70|alpha',
            'description'          => 'required|alpha_dash|max:350',
        ],
        [
            'unique' => 'This :attribute already in Role table please enter unique role',
        ]
        );
        
        $role = Role::create($request->only('role_name','description'));

        return $this->success('create role Successfully',$role);
    }

    //update Role

    public function update(Request $request, Role $data){
   
        $validatedata = Validator::make($request->all(), [
            'role_name'              => 'required|alpha|max:70',
            'description'          => 'required|alpha_dash|max:350',
        ],
        [
            'unique' => 'This :attribute already in Role table please enter unique role ',
        ]
    );
        
        if($validatedata->fails()){
            return $this->ErrorResponse($validatedata);
        }

        $data->delete();
        $updaetedata = $data->create($request->only('role_name','description'));
        
        return $this->success('Role updated Successfully',$updaetedata);
    }

    //delete role
    public function delete($id){
        $role = Role::find($id);   

        if(is_null($role)){
            return $this->DataNotFound();   
        }
            $role->delete();
            return $this->success('Role Deleted Successfully');
    }

    //get role By id
    public function get($id){
        $role = Role::find($id);

        if(is_null($role)){
            return $this->DataNotFound();
        }
        return $this->success('Role Detatils',$role);
    }

}


