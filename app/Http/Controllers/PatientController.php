<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\User;

class PatientController extends Controller
{
    public function index(){
        $patient = User::with([
            'gender' => function($q){
                $q->select('id', 'name');
            },
        ])
        ->where('id_level', 2)
        ->orderBy('nama', 'asc')
        ->get();

        return ['status' => "success", 'data' => $patient, 'message' => 'Success'];
    }

    public function detailPatient($id){
        $patient = User::with([
            'gender' => function($q){
                $q->select('id', 'name');
            },
        ])
        ->where('id', $id)
        ->first();
        return ['status' => "success", 'data' => $patient, 'message' => 'Success'];
    }
}
