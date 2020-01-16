<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Verlof extends Model
{
    //
    public function approve()
    {
        $this->isgoedgekeurd = true;
    }
}
