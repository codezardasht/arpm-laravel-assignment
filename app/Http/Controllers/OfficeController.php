<?php

namespace App\Http\Controllers;

use App\Actions\GetOfficeEmployees;

class OfficeController extends Controller
{
    public function index()
    {
        $result = app(GetOfficeEmployees::class)->execute();

        return response()->json($result);
    }
}
