<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PayCongress extends Model
{
    protected $table    = 'pay_congresses';

    protected $hidden   = ['created_at','updated_at']; 

    protected $fillable = ['iduser', 'idpresentation', 'document', 'check', 'date' ]; 
    
    public function user() {
        return $this->belongsTo('App\User', 'iduser');
    }
    public function presentation() {
        return $this->belongsTo('App\Presentation', 'idpresentation');
    }
}
