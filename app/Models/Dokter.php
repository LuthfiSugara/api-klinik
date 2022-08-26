<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Dokter extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'dokter';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'id_specialist',
        'id_level',
        'id_gender',
        'tanggal_lahir',
        'mulai_praktek',
        'keterangan',
        'foto',
        'biaya',
    ];

    protected $appends = [
        'lama_kerja'
    ];

    public function specialist(){
        return $this->belongsTo(Specialist::class, 'id_specialist', 'id');
    }

    public function gender(){
        return $this->belongsTo(Gender::class, 'id_gender', 'id');
    }

    public function getLamaKerjaAttribute(){
        $date = Carbon::parse($this->mulai_praktek);
        $now = Carbon::now();
        $diffYears = $date->diffInYears($now);
        $diffMonths = $date->diffInMonths($now);
        if($diffYears > 0){
            return $diffYears . " Tahun";
        }else{
            return $diffMonths . " Bulam";
        }
    }
}
