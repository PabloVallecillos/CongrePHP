<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPdfPresentation extends Model
{
    protected $table    = 'user_pdf_presentation';

    protected $hidden   = ['created_at','updated_at']; 

    protected $fillable = ['iduser', 'idpresentation'];

    public function user() {
        return $this->belongsTo('App\User', 'iduser');
    }
    public function presentation() {
        return $this->belongsTo('App\Presentation', 'idpresentation');
    }
}
