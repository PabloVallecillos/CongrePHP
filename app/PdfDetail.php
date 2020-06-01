<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PdfDetail extends Model
{
    protected $table    = 'pdf_details';

    protected $hidden   = ['created_at','updated_at']; 

    protected $fillable = ['iduser','first_name','last_name','card','email', 'phone'];
    
    public function user() {
        return $this->belongsTo('App\User', 'iduser');
    }

}
