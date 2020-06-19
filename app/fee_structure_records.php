<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fee_structure_records extends Model
{
    //
    protected $fillable = [
        'fee_structure_id', 'name','amount'
    ];
}
