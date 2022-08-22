<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Specialist extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'specialist';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
    ];
}
