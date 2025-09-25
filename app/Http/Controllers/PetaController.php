<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PetaController extends Controller
{
    public function showPetaSurvey()
    {
        return view('petaSurvey'); // Akan kita buat view-nya
    }
}
