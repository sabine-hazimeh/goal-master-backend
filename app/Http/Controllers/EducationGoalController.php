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
    public function show(EducationGoal $education)
    {
        return response()->json([
            "education goal" => $education
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEducationGoalRequest $request, EducationGoal $education)
    {
        $education->update($request->validated());
        return response()->json([
            "education goal" => $education
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EducationGoal $education)
    {
        $goal = Goal::where('id', $education->goal_id)->first();
        $education->delete();
        if ($goal) {
            $goal->delete();
        }
        return response()->json(["message" => "EducationGoal and corresponding Goal deleted successfully"], 200);
    }

    public function DisplayEducationGoal()
    {
        $userId = auth()->id();
        $educationGoals = EducationGoal::whereHas('goal', function($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();
    
        return response()->json(['educationGoal' => $educationGoals], 200);
    }
    
}
