<?php

namespace App\Http\Controllers;

use App\Models\EducationGoal;
use App\Http\Requests\StoreEducationGoalRequest;
use App\Http\Requests\UpdateEducationGoalRequest;
use App\Models\Goal;
class EducationGoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $educationGoal = EducationGoal::all();
        return response()->json(["education goal" => $educationGoal],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEducationGoalRequest $request)
    {
        $goal = Goal::create([
            'type' => "education",
            'user_id' => auth()->id(),
        ]);
        $validatedData = $request->validated();
        $validatedData['goal_id'] = $goal->id;
        $educationGoal = EducationGoal::create($validatedData);
        return response()->json(["education goal" => $educationGoal], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(EducationGoal $educationGoal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EducationGoal $educationGoal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEducationGoalRequest $request, EducationGoal $educationGoal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EducationGoal $educationGoal)
    {
        //
    }
}
