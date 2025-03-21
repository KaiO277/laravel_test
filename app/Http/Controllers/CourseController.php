<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with('students')->get();

        return response()->json([
            'status' => 'success',
            'data' => $courses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'name' =>'required|string',
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validate->errors()
            ], 400);
        }

        $course = Course::create($request->all());
        return response()->json([
            'status' => 'success',
            'data' => $course
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $course  = Course::find($id);

        if(!$course){
            return response()->json([
                'status' => 'error',
                'message' => 'Course not found'
            ], 404);
        }

        $course->update($request->all());
        return response()->json([
            'status' => 'success',
            'data' => $course
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::find($id);
        if(!$course){
            return response()->json([
                'status' => 'error',
                'message' => 'Course not found'
            ], 404);
        }
        $course->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Course deleted successfully'
        ]);
    }
}
