<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        return response()->json(['subjects' => $subjects], Response::HTTP_OK);
    }

    public function show(Subject $subject)
    {
        return response()->json(['subject' => $subject], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $subject = Subject::create($request->all());
        return response()->json(['subject' => $subject], Response::HTTP_CREATED);
    }

    public function update(Request $request, Subject $subject)
    {
        $subject->update($request->all());
        return response()->json(['subject' => $subject], Response::HTTP_OK);
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return response()->json(['message' => 'successfully deleted data']);
    }
}
