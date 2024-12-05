<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Name extends Model
{
    public function family()
    {
        return $this->belongsTo('App\Models\Family');
    }
}
