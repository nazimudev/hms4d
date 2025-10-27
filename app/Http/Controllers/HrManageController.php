<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class HrManageController extends Controller
{
    // Create Designation Page
    public function createDesignation()
    {
        return Inertia::render('hr_managment/CreateDesignation');
    }
}
