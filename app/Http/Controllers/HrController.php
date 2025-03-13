<?php

namespace App\Http\Controllers;

use App\Models\HrEmployee;
use App\Models\HrPerformance;
use Illuminate\Http\Request;

class HrController extends Controller
{
    public function index(Request $request)
    {
        $query = HrEmployee::with('performance');
        
        // ค้นหา
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('EmployeeID', 'LIKE', "%{$search}%")
                  ->orWhere('Title', 'LIKE', "%{$search}%")
                  ->orWhere('DepartmentType', 'LIKE', "%{$search}%");
            });
        }

        // กรองตามแผนก
        if ($request->has('department') && $request->department != '') {
            $query->where('DepartmentType', $request->department);
        }

        // กรองตามสถานะ
        if ($request->has('status') && $request->status != '') {
            $query->where('EmployeeStatus', $request->status);
        }

        $employees = $query->get();
        $departments = HrEmployee::distinct()->pluck('DepartmentType');
        $statuses = HrEmployee::distinct()->pluck('EmployeeStatus');

        return view('hr.index', compact('employees', 'departments', 'statuses'));
    }

    public function create()
    {
        return view('hr.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'EmployeeID' => 'required|unique:hr_employees',
            'Title' => 'required',
            'DepartmentType' => 'required',
            'EmployeeStatus' => 'required',
        ]);

        // สร้าง array ของข้อมูลที่จะบันทึก
        $employeeData = $request->all();
        
        // กำหนดค่าเริ่มต้นสำหรับฟิลด์ที่จำเป็น
        $employeeData['StartDate'] = now()->format('Y-m-d');
        $employeeData['PayZone'] = $employeeData['PayZone'] ?? 'Zone A';
        $employeeData['EmployeeType'] = $employeeData['EmployeeType'] ?? 'Full Time';
        $employeeData['BusinessUnit'] = $employeeData['BusinessUnit'] ?? 'Main Office';
        $employeeData['EmployeeClassificationType'] = $employeeData['EmployeeClassificationType'] ?? 'Regular';
        $employeeData['Division'] = $employeeData['Division'] ?? 'Main';
        $employeeData['DOB'] = $employeeData['DOB'] ?? '1990-01-01';
        $employeeData['State'] = $employeeData['State'] ?? 'BKK';
        $employeeData['GenderCode'] = $employeeData['GenderCode'] ?? 'M';
        $employeeData['RaceDesc'] = $employeeData['RaceDesc'] ?? 'Asian';
        $employeeData['MaritalDesc'] = $employeeData['MaritalDesc'] ?? 'Single';
        $employeeData['Age'] = $employeeData['Age'] ?? 30;

        $employee = HrEmployee::create($employeeData);

        if ($request->has('PerformanceScore')) {
            HrPerformance::create([
                'EmployeeID' => $employee->EmployeeID,
                'PerformanceScore' => $request->PerformanceScore,
                'CurrentEmployeeRating' => $request->CurrentEmployeeRating ?? 3,
                'EngagementScore' => $request->EngagementScore ?? 3,
                'SatisfactionScore' => $request->SatisfactionScore ?? 3,
                'WorkLifeBalanceScore' => $request->WorkLifeBalanceScore ?? 3,
            ]);
        }

        return redirect()->route('hr.index')->with('success', 'เพิ่มข้อมูลพนักงานเรียบร้อยแล้ว');
    }

    public function edit($id)
    {
        $employee = HrEmployee::with('performance')->findOrFail($id);
        return view('hr.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Title' => 'required',
            'DepartmentType' => 'required',
            'EmployeeStatus' => 'required',
        ]);

        $employee = HrEmployee::findOrFail($id);
        $employee->update($request->all());

        if ($employee->performance) {
            $employee->performance->update([
                'PerformanceScore' => $request->PerformanceScore,
                'CurrentEmployeeRating' => $request->CurrentEmployeeRating,
                'EngagementScore' => $request->EngagementScore,
                'SatisfactionScore' => $request->SatisfactionScore,
                'WorkLifeBalanceScore' => $request->WorkLifeBalanceScore,
            ]);
        }

        return redirect()->route('hr.index')->with('success', 'อัพเดทข้อมูลพนักงานเรียบร้อยแล้ว');
    }

    public function destroy($id)
    {
        $employee = HrEmployee::findOrFail($id);
        if ($employee->performance) {
            $employee->performance->delete();
        }
        $employee->delete();

        return redirect()->route('hr.index')->with('success', 'ลบข้อมูลพนักงานเรียบร้อยแล้ว');
    }

    public function show($id)
    {
        $employee = HrEmployee::with('performance')->findOrFail($id);
        return view('hr.show', compact('employee'));
    }
} 