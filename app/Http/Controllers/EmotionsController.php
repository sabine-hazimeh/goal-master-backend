<?php

namespace App\Http\Controllers;

use App\Models\Emotions;
use App\Http\Requests\StoreEmotionsRequest;
use App\Http\Requests\UpdateEmotionsRequest;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class EmotionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emotions = Emotions::all();
        return response()->json(["emotions" => $emotions], 200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmotionsRequest $request)
    {
        $emotions = Emotions::create($request->validated());
        return response()->json(["emotions" => $emotions], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Emotions $emotion)
    {
        return response()->json(["emotions" => $emotion], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmotionsRequest $request, Emotions $emotion)
    {
       $emotion->update($request->validated());
       return response()->json(["emotions" => $emotion], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Emotions $emotion)
    {
        $emotion->delete();
        return response()->json(["message" => "Emotion deleted successfully"], 200);
    }
    public function getSentimentData()
    {
        
        $data = DB::table('emotions')
                    ->select('emotion', 'created_at')
                    ->where('type', 'detected')
                    ->get();

        
        $emotionMapping = [
            'happy' => 2,
            'neutral' => 0,
            'sad' => -1,
            'angry' => -2,
            'surprised' => 1,
        ];

       
        $data->transform(function ($item) use ($emotionMapping) {
            $item->sentiment_score = $emotionMapping[$item->emotion] ?? 0;
            $item->created_at = Carbon::parse($item->created_at)->toDateString();
            return $item;
        });

        
        $sentimentOverTime = $data->groupBy('created_at')->map(function ($group) {
            return [
                'date' => $group->first()->created_at,
                'average_sentiment' => $group->avg('sentiment_score'),
            ];
        });

        return response()->json($sentimentOverTime->values()->all());
    }
}
