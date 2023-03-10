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
        $roles = Role::where('is_active','1')->get();

        if($roles){
            return $this->success('List Roles',$roles);
        }
        else {
            return $this->DataNotFound();
        }
    }

    //create Role
    public function create(Request $request){
        $validatedata = Validator::make($request->all(), [
            'role_name'              => 'required|unique:roles,role_name|max:70|string',
            'description'          => 'required|string|max:350',
        ],
        [
            'unique' => 'This :attribute already in Role table please enter unique role',
        ]    
        );

        if($validatedata->fails()){
            return $this->ErrorResponse($validatedata);
        }
        
        $role = Role::create($request->only('role_name','description'));

        return $this->success('create role Successfully',$role);
    }

    //update Role
    public function update(Request $request, $id){
        
        $validatedata = Validator::make($request->all(), [
            'role_name'              => 'string|max:70|unique:roles,role_name',
            'description'            => 'required|string|max:350',
            'is_active'              => 'boolean|numeric'
        ],
        [
            'boolean'                => 'this field access only 1(active) or 0(deactive)'
        ]
    );
        
       
        if($validatedata->fails()){
            return $this->ErrorResponse($validatedata);
        }
        
        $data = Role::find($id);
        if($data){
        $data->update($request->only('role_name','description'));
        return $this->success('Role updated Successfully',$data);
        }
        else{
            return $this->DataNotFound();
        }
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


