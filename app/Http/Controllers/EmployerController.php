<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployerRequest;
use App\Http\Requests\UpdateEmployerRequest;
use App\Models\Employer;
use Illuminate\Support\Facades\Auth;

class EmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEmployerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployerRequest $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'company_name' => 'required|string',
            'company_size' => 'required',
            'location' => 'required',
        ]);
        $data['user_id'] = Auth::user()->id;
        Employer::create($data);
        return response()->json([
            'success' => 'Profile created successfully',
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $employer = Employer::findOrFail($id);

        return response()->json(['data' =>$employer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployerRequest  $request
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployerRequest $request, Employer $employer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employer = Employer::findOrFail($id);
        if ($employer->user_id != auth()->user()->id) {
            return response()->json(['error' => 'Unauthorized access'], 401);
        }
        $employer->delete();

        return response()->json(['message' => 'Account deleted successfully']);
    }
}
