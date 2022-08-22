<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Gender;

class SettingController extends Controller
{
    public function gender(){
        $genders = Gender::all();
        if($genders){
            return ['status' => "success", 'data' => $genders, 'message' => 'Berhasil mendapatkan data'];
        }else{
            return ['status' => "fail", 'message' => 'Gagal mendapatkan data'];
        }
    }
}
