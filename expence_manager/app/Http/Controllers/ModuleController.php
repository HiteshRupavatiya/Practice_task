<?php

namespace App\Http\Controllers;
use App\Models\Module;
use Illuminate\Http\Request;
use App\Traits\ResponseMessage;
use Illuminate\Support\Facades\Validator;

class ModuleController extends Controller
{
    use ResponseMessage;

    //List Modules
    public function list(){
        $modules = Module::all();

        if(count($modules) > 0){
            return $this->success('List Modules',$modules);
        }
        else {
            return $this->DataNotFound();
        }
    }

    //create Module
    public function create(Request $request){
        $validatedata = Validator::make($request->all(), [
            'code'              => 'required|unique:modules,code|alpha_dash|min:2|max:20',
            'name'          => 'required|string|max:70|unique:modules,name',
        ],
        [
            'unique' => 'this :attribute already in modules table please  enter unique code values',
        ]
        );

        if($validatedata->fails()){
            return $this->ErrorResponse($validatedata);
        }
        
        $module = Module::create($request->only('code','name'));

        return $this->success('create Module Successfully',$module);
    }   

    //update Module
    public function update(Request $request, Module $data){

        $validatedata = Validator::make($request->all(), [
            'code'              => 'alpha_dash|min:2|max:20|unique:modules,code',
            'name'              => 'string|max:70|unique:modules,name',
        ],
        [
            'unique'    => 'this :attribute already in modules table please  enter unique code values',
        ]
        );
        
        if($validatedata->fails()){
            return $this->ErrorResponse($validatedata);
        }
        $data->update($request->only('code','name'));
        
        return $this->success('Modules updated Successfully',$data);
    
    }

    //Delete Module
    public function delete($code){
        $module = Module::find($code);
        if(is_null($module)){
            return $this->DataNotFound();
        }
        else{
            $module->delete();
            return $this->success('Module Deleted SuccessFully');
        }
    }

    //Get Module
    public function get($code){
        $module = Module::find($code);
        if (is_null($module)) {
            return $this->DataNotFound();
        }
        return $this->success('Module Details',$module);
    }


}

