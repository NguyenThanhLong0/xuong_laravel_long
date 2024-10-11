<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = Employee::paginate(10);
        return view('employees.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:employees,email|max:150',
            'phone' => 'required|string|max:15',
            'date_of_birth' => 'required|date',
            'hire_date' => 'required|date',
            'salary' => 'required|numeric',
            'is_active' => 'required|boolean',
            'department_id' => 'required|integer',
            'manager_id' => 'nullable|integer',
            'address' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Lưu file ảnh
        if ($request->hasFile('profile_picture')) {
            $validated['profile_picture'] = $request->file('profile_picture')->store('public/employees');
        }

        Employee::create($validated);

        return redirect()->route('employees.index')->with('success', 'Thêm nhân viên thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $employee = Employee::findOrFail($id);
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Lấy thông tin nhân viên cần chỉnh sửa
        $employee = Employee::findOrFail($id);
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:employees,email,' . $id . '|max:150',
            'phone' => 'required|string|max:15',
            'date_of_birth' => 'required|date',
            'hire_date' => 'required|date',
            'salary' => 'required|numeric',
            'is_active' => 'required|boolean',
            'department_id' => 'required|integer',
            'manager_id' => 'nullable|integer',
            'address' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $employee = Employee::findOrFail($id);


        if ($request->hasFile('profile_picture')) {

            if ($employee->profile_picture) {
                Storage::delete($employee->profile_picture);
            }
            $validated['profile_picture'] = $request->file('profile_picture')->store('public/employees');
        }


        $employee->update($validated);

        return redirect()->route('employees.index')->with('success', 'Cập nhật thông tin nhân viên thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $employee = Employee::findOrFail($id);


        if ($employee->profile_picture) {
            Storage::delete($employee->profile_picture);
        }

        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Xóa nhân viên thành công!');
    }
}
