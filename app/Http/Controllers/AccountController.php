<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    
    public function owner()
    {
        return $this->belongsTo('\App\User', 'owner_id');
    }
    
    
}
