<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;

class FilmViewController extends Controller
{
    public function liste()
    {
        return view('films.liste');
    }

    public function ajouter()
    {
        return view('films.ajouter');
    }

    public function modifier($id)
    {
        // On ne passe plus les données du film, tout sera chargé dynamiquement via l'API
        return view('films.modifier');
    }
}
