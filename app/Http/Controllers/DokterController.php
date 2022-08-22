<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Dokter;

class DokterController extends Controller
{
    public function index(){
        return Dokter::orderBy('nama', 'asc')->get();
    }
}
