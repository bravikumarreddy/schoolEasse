<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fee_structure extends Model
{
    protected $fillable = [
        'name', 'school_id'
    ];

     public function fee_structure_records(){
        $this->hasMany("fee_structure_records",fee_structure_id);
     }

     public function school(){
         $this->belongsTo("school","school_id");
     }
}
