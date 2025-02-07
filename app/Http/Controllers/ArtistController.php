<?php

namespace App\Http\Controllers;

use App\DataTables\SearchArtistDataTable;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public function index(){
        return view('artist.dashboard');
    }

    public function artist(SearchArtistDataTable $datatable){
        return $datatable->render('artist.search');
    }
}
