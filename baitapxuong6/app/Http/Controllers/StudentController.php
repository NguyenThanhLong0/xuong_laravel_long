<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::latest('id')->with('classroom', 'passport', 'subjects')->paginate(10);

        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classrooms = Classroom::all();

        $subjects = Subject::all();

        return view('students.create', compact('classrooms', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate dữ liệu
        $validator = Validator::make($request->all(), [
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|unique:students',
            'classroom_id'    => 'required|exists:classrooms,id',
            'passport_number' => 'required|unique:passports',
            'issued_date'     => 'required|date',
            'expiry_date'     => 'required|date',
            'subjects'        => 'required|array|exists:subjects,id',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {

            $data = $request->except('subjects');

            // Tạo student
            $student = Student::create($data);

            // Tạo passport cho student
            $student->passport()->create([
                'passport_number' => $request->passport_number,
                'issued_date'     => $request->issued_date,
                'expiry_date'     => $request->expiry_date,
            ]);

            // Liên kết subjects với student
            $student->subjects()->sync($request->subjects);

            return redirect()->route('students.index')->with('success', 'Thêm mới học sinh thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Thêm mới học sinh thất bại!')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $student = Student::with('passport', 'classroom', 'subjects')->findOrFail($id);
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $student = Student::with('passport', 'classroom', 'subjects')->findOrFail($id);
        $classrooms = Classroom::all();
        $subjects = Subject::all();
        return view('students.edit', compact('student', 'classrooms', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:students,email,' . $id,
            'classroom_id' => 'required',
            'passport_number' => 'required|unique:passports,passport_number,' . $id,
            'issued_date' => 'required|date',
            'expiry_date' => 'required|date',
            'subjects' => 'required|array',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $student = Student::findOrFail($id);
            $student->update($request->only(['name', 'email', 'classroom_id']));

            // Cập nhật passport
            $student->passport()->update($request->only(['passport_number', 'issued_date', 'expiry_date']));

            // Đồng bộ subjects
            $student->subjects()->sync($request->subjects);

            return redirect()->route('students.index')->with('success', 'Cập nhật thông tin sinh viên thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Cập nhật thông tin sinh viên thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return back()->with('success', 'Xóa thành công!');
    }
}
