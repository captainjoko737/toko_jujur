<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 	
		'id_user',     
        'id_barang',   
        'create_date',     
        'total',   
        'active',  
        'quantity',    
        'no_antrian', 
    ];

    protected $dates = ['create_date'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at', 'id',
    ];

    public function barang()
    {
         return $this->belongsTo('App\Models\Barang', 'id_barang');
    }
}
