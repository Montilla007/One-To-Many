<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('subjects')->get();
        return response()->json(['students' => $students], Response::HTTP_OK);
    }

    public function show(Student $student)
    {
        $student->load('subjects');
        return response()->json(['student' => $student], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $student = Student::create($request->all());
        if ($request->has('subjects')) {
            $student->subjects()->createMany($request->input('subjects'));
        }
        return response()->json(['student' => $student], Response::HTTP_CREATED);
    }

    public function update(Request $request, Student $student)
    {
        $student->update($request->all());
        if ($request->has('subjects')) {
            $student->subjects()->delete();
            $student->subjects()->createMany($request->input('subjects'));
        }
        return response()->json(['student' => $student], Response::HTTP_OK);
    }

    public function destroy(Student $student)
    {
        $student->subjects()->delete();
        $student->delete();
        return response()->json(['message' => 'successfully deleted data']);
    }
}
