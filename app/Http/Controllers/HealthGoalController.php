<?php

namespace App\Http\Controllers;

use App\Models\HealthGoal;
use App\Http\Requests\StoreHealthGoalRequest;
use App\Http\Requests\UpdateHealthGoalRequest;

class HealthGoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreHealthGoalRequest $request)
    {
        //
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
