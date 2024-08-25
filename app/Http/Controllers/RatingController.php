<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\MovieService\RatingService;
use Illuminate\Http\Request;
use App\Models\newRating;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    protected $ratingService;
    public function __construct(RatingService $ratingService){
        $this->ratingService = $ratingService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rating = newRating::all();
        return response()->json($rating , 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validationData = $request->validate([
            'user_id'=>'required',
            'movie_id'=>'required',
            'rating'=> 'required|integer|min:1|max:5',
            'review'=>'string',
        ]);
            // Find the movie by its ID
            $movie = Movie::findOrFail($request->movie_id);

            // Update the movie rating by adding the new rating
            $movie->rating = $request->rating + $movie->rating ;
            $movie->review = $request->review ;

            // Fetch all reviews related to the movie
            $allReviews = $movie->ratings()->pluck('review')->filter()->toArray();

            // Join all reviews into a single string
            $movie->review = implode(' | ', $allReviews);
            $movie->save();

            // Create the new rating and store it in the new_ratings table
            $rating = $this->ratingService->createRating($validationData);
            return response()->json($rating, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rating = newRating::findOrFail($id);
        return response()->json($rating , 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return response()->json([
            'status'=>false ,
            'message'=>'You Cant Update the rating',
        ],422);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return response()->json([
            'status'=>false ,
            'message'=>'You cant delete the rating ',
        ]);
    }
}
