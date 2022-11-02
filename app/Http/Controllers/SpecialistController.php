<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Specialist;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SpecialistController extends Controller
{
    public function index(){
        $data = Specialist::orderBy('id', 'asc')->get();
        return ['status' => "success", 'data' => $data, 'message' => 'Success'];
    }

    public function addSpecialist(Request $request){

        $specialist = Specialist::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        if($specialist){
            return ['status' => "success", 'message' => 'Success'];
        }else{
            return ['status' => "fail", 'message' => 'Failed'];
        }
    }

    public function editSpecialist(Request $request, $id){

        $validator = Validator::make($request->all(),
            [
                'name' => [Rule::unique('specialist')->ignore($id)]
            ]
        );

        if($validator->fails()){
            return ['status' => "fail", 'message' => 'Specialist sudah ada'];
        }else{
            $specialist = Specialist::where('id', $id)
            ->update([
                'name' => $request->name,
                'description' => $request->description
            ]);

            if($specialist){
                return ['status' => "success", 'message' => 'Success'];
            }else{
                return ['status' => "fail", 'message' => 'Failed'];
            }
        }
    }

    public function deleteSpecialist($id){
        $delete = Specialist::where('id', $id)->delete();

        if($delete){
            return ['status' => "success", 'message' => 'Success'];
        }else{
            return ['status' => "fail", 'message' => 'Failed'];
        }
    }
}
