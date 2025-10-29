<?php

namespace App\Http\Controllers;

use App\Http\Requests\DesignationCreate;
use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
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
            return back()->with('success', 'Designation Created Successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    // Designation List Page
    public function designationList()
    {

        $designations = Designation::orderBy('id', 'desc')->paginate(10);

        return Inertia::render('hr_managment/DesignationList', [
            'designations' => $designations
        ]);
    }



    // Designation Delete
    public function designationDelete($id)
    {
        try {
            Designation::find($id)->delete();
            return back()->with('success', 'Designation Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    // Department Create Page
    public function createDepartment()
    {
        return Inertia::render('hr_managment/CreateDepartment');
    }

    // Department Store Function
    public function storeDepartment(DepartmentRequest $departmentRequest)
    {
        $validatedData = $departmentRequest->validated();
        try {
            Department::create($validatedData);
            return back()->with('success', 'Department Created Successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
