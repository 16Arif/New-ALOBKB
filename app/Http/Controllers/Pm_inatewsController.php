<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\FlareClient\View;

class Pm_inatewsController extends Controller
{
    public function index()
    {
        return View('pages.pm-inatews.index');
    }
}
