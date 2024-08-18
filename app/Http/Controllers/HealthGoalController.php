<?php

namespace App\Http\Controllers;

use App\Models\HealthGoal;
use App\Http\Requests\StoreHealthGoalRequest;
use App\Http\Requests\UpdateHealthGoalRequest;
use App\Models\Goal;
class HealthGoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $healthGoal = HealthGoal::all();
        return response()->json(["health goal" => $healthGoal],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHealthGoalRequest $request)
    {
        $goal = Goal::create([
            'type' => "health",
            'user_id' => auth()->id(),
        ]);
        $validatedData = $request->validated();
        $validatedData['goal_id'] = $goal->id;
        $healthGoal = HealthGoal::create($validatedData);
        return response()->json(["health goal" => $healthGoal], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(HealthGoal $healthGoal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HealthGoal $healthGoal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHealthGoalRequest $request, HealthGoal $healthGoal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HealthGoal $healthGoal)
    {
        //
    }
}
