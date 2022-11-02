<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValidationUser extends Model
{
    use HasFactory;

    protected $table = 'validation_user';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_user',
        'key_validation',
    ];
}
