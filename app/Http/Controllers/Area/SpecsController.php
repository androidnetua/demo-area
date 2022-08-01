<?php

namespace App\Http\Controllers\Area;

use App\Http\Controllers\Controller;
use App\Http\Resources\SpecsVendorResource;
use App\Models\SpecsVendor;

class SpecsController extends Controller
{
    public function vendors()
    {
        return SpecsVendorResource::collection(SpecsVendor::orderBy('name')->get());
    }
}
