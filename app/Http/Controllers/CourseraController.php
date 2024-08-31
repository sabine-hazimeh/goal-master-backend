<?php

namespace App\Http\Controllers;

use App\Models\Coursera;
use App\Http\Requests\StoreCourseraRequest;
use App\Http\Requests\UpdateCourseraRequest;

class CourseraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $courseras = Coursera::all();
       return response()->json(["courseras" => $courseras], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseraRequest $request)
    {
        $coursera = Coursera::create($request->validated());
        return response()->json(["coursera" => $coursera], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Coursera $coursera)
    {
        return response()->json(["coursera" => $coursera], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coursera $coursera)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseraRequest $request, Coursera $coursera)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coursera $coursera)
    {
        //
    }
}
