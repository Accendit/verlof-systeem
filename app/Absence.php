<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    //
    protected $fillable = [
        'isapproved', 'startdate', 'enddate', 'submitter'
    ];

    /**
     * This function will approve a user's Absence request.
     * 
     * @return void
     */
    public function approve()
    {
        $this->isapproved = true;
        $this->save();
    }

    /**
     * This function will disapprove a user's Absence request.
     * 
     * @return void
     */
    public function disapprove()
    {
        $this->isapproved = false;
        $this->save();
    }

    public function submitter()
    {
        return $this->hasOne('App\User', 'id', 'submitter')->first();
    }
}
