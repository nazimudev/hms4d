<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [

            // 🏠 Dashboard
            ['name' => 'dashboard.view', 'display_name' => 'View Dashboard', 'category' => 'Dashboard'],

            // 🧪 Test Manage
            ['name' => 'test.view', 'display_name' => 'View Test List', 'category' => 'Test Manage'],
            ['name' => 'test.create', 'display_name' => 'Add Test', 'category' => 'Test Manage'],
            ['name' => 'test.edit', 'display_name' => 'Edit Test', 'category' => 'Test Manage'],
            ['name' => 'test.delete', 'display_name' => 'Delete Test', 'category' => 'Test Manage'],

            // 👥 User & Role Manage
            ['name' => 'user.view', 'display_name' => 'View User List', 'category' => 'User Manage'],
            ['name' => 'user.create', 'display_name' => 'Add New User', 'category' => 'User Manage'],
            ['name' => 'user.edit', 'display_name' => 'Edit User', 'category' => 'User Manage'],
            ['name' => 'user.delete', 'display_name' => 'Delete User', 'category' => 'User Manage'],

            ['name' => 'role.view', 'display_name' => 'View Role List', 'category' => 'Role Manage'],
            ['name' => 'role.create', 'display_name' => 'Add New Role', 'category' => 'Role Manage'],
            ['name' => 'role.edit', 'display_name' => 'Edit Role', 'category' => 'Role Manage'],
            ['name' => 'role.delete', 'display_name' => 'Delete Role', 'category' => 'Role Manage'],

            // 📅 Appointment Manage
            ['name' => 'appointment.view', 'display_name' => 'View Booking List', 'category' => 'Appointment'],
            ['name' => 'appointment.create', 'display_name' => 'New Booking', 'category' => 'Appointment'],
            ['name' => 'appointment.edit', 'display_name' => 'Edit Booking', 'category' => 'Appointment'],
            ['name' => 'appointment.delete', 'display_name' => 'Delete Booking', 'category' => 'Appointment'],

            // 👨‍⚕️ Doctor Manage
            ['name' => 'doctor.view', 'display_name' => 'View Doctor List', 'category' => 'Doctor Manage'],
            ['name' => 'doctor.create', 'display_name' => 'Add Doctor', 'category' => 'Doctor Manage'],
            ['name' => 'doctor.edit', 'display_name' => 'Edit Doctor Info', 'category' => 'Doctor Manage'],
            ['name' => 'doctor.delete', 'display_name' => 'Delete Doctor', 'category' => 'Doctor Manage'],
            ['name' => 'doctor.commission', 'display_name' => 'Commission Setup', 'category' => 'Doctor Manage'],
            ['name' => 'doctor.leave', 'display_name' => 'Manage Doctor Leave', 'category' => 'Doctor Manage'],

            // 🧾 UHID Manage
            ['name' => 'uhid.view', 'display_name' => 'View Registration List', 'category' => 'UHID Manage'],
            ['name' => 'uhid.create', 'display_name' => 'Add Registration', 'category' => 'UHID Manage'],
            ['name' => 'uhid.edit', 'display_name' => 'Edit Registration', 'category' => 'UHID Manage'],
            ['name' => 'uhid.delete', 'display_name' => 'Delete Registration', 'category' => 'UHID Manage'],

            // 💊 Pharmacy
            ['name' => 'pharmacy.view', 'display_name' => 'View Pharmacy List', 'category' => 'Pharmacy'],
            ['name' => 'pharmacy.sale', 'display_name' => 'Make Sale (POS)', 'category' => 'Pharmacy'],
            ['name' => 'pharmacy.purchase', 'display_name' => 'Make Purchase', 'category' => 'Pharmacy'],
            ['name' => 'pharmacy.stock', 'display_name' => 'View Stock Report', 'category' => 'Pharmacy'],
            ['name' => 'pharmacy.return', 'display_name' => 'Sales Return / Purchase Return', 'category' => 'Pharmacy'],

            // 🏥 Hospital/IPD
            ['name' => 'ipd.view', 'display_name' => 'View Admission List', 'category' => 'Hospital/IPD'],
            ['name' => 'ipd.create', 'display_name' => 'New Admission', 'category' => 'Hospital/IPD'],
            ['name' => 'ipd.billing', 'display_name' => 'Manage Billing', 'category' => 'Hospital/IPD'],
            ['name' => 'ipd.discharge', 'display_name' => 'Discharge Patient', 'category' => 'Hospital/IPD'],
            ['name' => 'ipd.operation', 'display_name' => 'Operation Cost', 'category' => 'Hospital/IPD'],

            // 🚑 Ambulance
            ['name' => 'ambulance.view', 'display_name' => 'View Ambulance List', 'category' => 'Ambulance'],
            ['name' => 'ambulance.create', 'display_name' => 'Add Ambulance', 'category' => 'Ambulance'],
            ['name' => 'ambulance.receipt', 'display_name' => 'Create / View Receipt', 'category' => 'Ambulance'],

            // 👨‍💼 HR Manage
            ['name' => 'hr.view', 'display_name' => 'View Staff List', 'category' => 'HR Manage'],
            ['name' => 'hr.create', 'display_name' => 'Add Staff', 'category' => 'HR Manage'],
            ['name' => 'hr.salary_generate', 'display_name' => 'Generate Salary', 'category' => 'HR Manage'],
            ['name' => 'hr.salary_payment', 'display_name' => 'Salary Payment', 'category' => 'HR Manage'],

            // 📊 Reports / MIS
            ['name' => 'report.view', 'display_name' => 'View Reports', 'category' => 'MIS Reports'],
            ['name' => 'report.generate', 'display_name' => 'Generate MIS Report', 'category' => 'MIS Reports'],

        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission['name']], $permission);
        }
    }
}
