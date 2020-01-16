<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    //
    public function approve()
    {
        $this->isgoedgekeurd = true;
    }
}
