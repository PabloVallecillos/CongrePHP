<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Presentation extends Model
{
    use SoftDeletes;

    protected $table    = 'presentations';

    protected $hidden   = ['created_at','updated_at']; 

    protected $fillable = ['iduser', 'tittle', 'video', 'miniature', 'description', 'pay', 'document', 'iduserPay']; 
     
 
    public function user() {
        return $this->belongsTo('App\User', 'iduser');
    }

}
