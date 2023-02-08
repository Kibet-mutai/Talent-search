<?php

namespace App\Http\Controllers;

use App\Models\Freelancer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FreelanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view_profile()
    {
        $freelancers = Freelancer::paginate(6);
        return response()->json(['data' => $freelancers]);
    }


    //search controller
    public function search(Request $request)
    {
        try
        {
            $search = $request->input('search');
            $freelancers = Freelancer::where('first_name', 'like', '%' . $search . '%')
                                ->orWhere('location', 'like', '%' . $search . '%')
                                ->orWhere('skills', 'like', '%' . $search . '%')
                                ->get();

            if (!$freelancers->count()) {
                throw new \Exception("No results found for the search query.");
            }

            return response()->json(['freelancers' => $freelancers]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }


    //filter controller by ratings

    public function filter(Request $request)
    {
        try {
            $review = $request->input('rating');
            $freelancers = Freelancer::whereHas('review', function ($query) use ($review) {
                $query->where('rating', $review);
            })->get();

            return response()->json([
                'status' => 'success',
                'data' => $freelancers
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }








    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create_profile(Request $request)
    {
        $user = Auth::user();
        if ($user->freelancer) {
            return response()->json(['error' => 'You already have a freelancer profile']);
        }
        $validatedData = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'skills' => 'required|string',
            'location' => 'required|string',
            'gender' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'resume' => 'required|mimes:docx,pdf'
        ]);

        if ($request->hasFile('image') && $request->hasFile('resume')) {
            $validatedData['image'] = $request->file('image')->store('images', 'public');
            $validatedData['resume'] = $request->file('resume')->store('resume', 'public');
        }
        $validatedData['user_id'] = Auth::user()->id;
        Freelancer::create($validatedData);
        return response()->json([
            'success' => 'Profile created successfully',
            'validated_data' => $validatedData
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile_detail($id)
    {
        $freelancer = Freelancer::findOrFail($id);

        return response()->json(['data' => $freelancer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_profile(Request $request, $id)
    {

        $freelancer = Freelancer::findOrFail($id);
        // dd($freelancer);
        if ($freelancer->user_id != auth()->user()->id) {
            return response()->json(['error' => 'Unauthorized access'], 401);
        }
        $validatedData = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'skills' => 'required|string',
            'location' => 'required|string',
            'gender' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'resume' => 'nullable|mimes:docx,pdf'
        ]);

        if ($request->hasFile('image') && $request->hasFile('resume')) {
            $validatedData['image'] = $request->file('image')->store('images', 'public');
            $validatedData['resume'] = $request->file('resume')->store('resume', 'public');
        }
        $freelancer->update($validatedData);
        return response()->json(['success' => 'Profile updated successfully', 'data' => $validatedData]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_profile($id)
    {


        $freelancer = Freelancer::findOrFail($id);
        if ($freelancer->user_id != auth()->user()->id) {
            return response()->json(['error' => 'Unauthorized access'], 401);
        }
        $freelancer->delete();

        return response()->json(['message' => 'Freelancer deleted successfully']);


    }
}
