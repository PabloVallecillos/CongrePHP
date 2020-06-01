<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserPresentation extends Model
{
    use SoftDeletes;

    protected $table    = 'user_presentations';

    protected $hidden   = ['created_at','updated_at']; 
    
    protected $fillable = ['idpresentation', 'iduser']; 
    
    public function user() {
        return $this->belongsTo('App\User', 'iduser');
    }
    
    public function presentations()
    {
        return $this->hasMany('App\Presentation');
    }
}
