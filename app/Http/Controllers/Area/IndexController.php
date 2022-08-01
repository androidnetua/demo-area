<?php

namespace App\Http\Controllers\Area;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {
        return view('area.index');
    }
}
