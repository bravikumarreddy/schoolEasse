<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class student_instalments extends Model
{
    //
    protected $fillable = [
        'fee_structure_id',"instalment_id","student_id","paid"
    ];
}
