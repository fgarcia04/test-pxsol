<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFile extends Model
{
    protected $fillable = [
        'user_id',
        'file_name',
        'url',
        'created_at'
    ];

    protected $hidden = [
        'user_id',
        'updated_at',
        'deleted_at',
    ];

}
