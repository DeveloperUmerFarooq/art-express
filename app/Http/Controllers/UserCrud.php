<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use Illuminate\Http\Request;

class UserCrud extends Controller
{
    public function index(UsersDataTable $datatable){
            return $datatable->render('admin.user-management.user');
            // dd($datatable);
    }
}
