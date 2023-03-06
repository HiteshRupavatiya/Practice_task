<?php

namespace App\Http\Controllers;
use App\Models\Module;
use App\Traits\ResponseMessage;
use Illuminate\Http\Request;
// use App\Traits\ResponseMessage;

class ModuleController extends Controller
{
    use ResponseMessage;
    public function list(){
        $modules = Module::all();

        if(count($modules) > 0){
            return $this->success('List Modules',$modules);
        }
        else {
            return $this->DataNotFound();
        }
    }

    // public function create(Request $request){
    //     $validateaccountdata = Validator::make($input, [
    //         'account_name'      => 'required|max:30',
    //         'account_number'    => 'required|min:10|max:12|unique:accounts,account_number',
    //     ],
    //     [
    //         'exists'    => 'This :attribute is not in user table please enter valid user_id'
    //     ]
    // );

    
}
