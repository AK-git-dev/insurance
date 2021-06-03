<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class insurance extends Model
{
    //
    protected $table = 'insurances';
    protected $fillable = [
        'policy', 'location','region','insuredvalue','businesstype'
    ];
    protected $guarded = array();
}
