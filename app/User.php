<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',    
        'username',    
        'nama',    
        'alamat',  
        'jenis_kelamin',   
        'active',  
        'access', 
        'rfid',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function saldo()
    {
         return $this->belongsTo('App\Models\Saldo', 'id');
    }
}

