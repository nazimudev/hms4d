<?php

namespace App\Http\Controllers;

use App\Http\Requests\DesignationCreate;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;

class HrManageController extends Controller
{
    // Create Designation Page
    public function createDesignation()
    {
        return Inertia::render('hr_managment/CreateDesignation');
    }

    // Store Designation Data
    public function storeDesignation(DesignationCreate $designationCreate)
    {
        $valiatedData = $designationCreate->validated();
        try {
            Designation::create($valiatedData);
            $pages = ceil(Designation::count() / 10);
            for ($i = 1; $i <= $pages; $i++) {
                Cache::forget("designations_page_{$i}");
            }
            Cache::forget("designations");
            return back()->with('success', 'Designation Created Successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    // Designation List Page
    public function designationList()
    {
        // $designations = Designation::all();
        $page = request()->get('page', 1);
        $designations = Cache::remember("designations_page_{$page}", 60, function () {
            return Designation::orderBy('id', 'desc')->paginate(10);
        });
        return Inertia::render('hr_managment/DesignationList', [
            'designations' => $designations
        ]);
    }

    // Designation Delete
    public function designationDelete($id)
    {
        try {
            Designation::find($id)->delete();
            Cache::forget("designations");
            return back()->with('success', 'Designation Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
