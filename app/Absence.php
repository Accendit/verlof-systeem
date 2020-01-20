<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    //
    protected $fillable = [
        'isapproved', 'startdate', 'enddate', 'submitter'
    ];

    public function approve()
    {
        $this->isapproved = true;
        $this->save();
    }

    public function submitter()
    {
        return $this->hasOne('App\User', 'id', 'submitter')->first();
    }
}
