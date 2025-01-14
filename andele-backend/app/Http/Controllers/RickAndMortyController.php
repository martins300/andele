<?php

namespace App\Http\Controllers;

use App\Http\Services\RickService;
use Illuminate\Http\Request;

class RickAndMortyController extends Controller
{
    /**
     * Display a listing of the characters.
     */
    public function list()
    {
        return RickService::getRandomPage();
    }

    /**
     * Show one character by id.
     */
    public function character(Request $request, int $id)
    {
        return RickService::getCharacter($id);
    }

}
