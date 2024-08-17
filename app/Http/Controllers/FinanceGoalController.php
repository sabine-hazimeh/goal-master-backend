<?php

namespace App\Http\Controllers;

use App\Models\FinanceGoal;
use App\Http\Requests\StoreFinanceGoalRequest;
use App\Http\Requests\UpdateFinanceGoalRequest;

class FinanceGoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $financeGoal = FinanceGoal::all();
        return response()->json(["finance goal" => $financeGoal],);
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
    public function store(StoreFinanceGoalRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(FinanceGoal $financeGoal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FinanceGoal $financeGoal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFinanceGoalRequest $request, FinanceGoal $financeGoal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FinanceGoal $financeGoal)
    {
        //
    }
}
