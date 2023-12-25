<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyUser extends Model
{
    public $timestamps = false;
	protected $table = 'myusers';
	protected $primaryKey = 'login';
	protected $keyType = 'string';
}
