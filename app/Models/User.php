<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class User extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='users';
    protected $guarded=[];

    public function UserDepartment()
    {
        return $this->belongsTo(department::class, 'fk_department', 'id');
    }

    public function UserDesignation()
    {
        return $this->belongsTo(designation::class, 'fk_designation', 'id');
    }


    
}
