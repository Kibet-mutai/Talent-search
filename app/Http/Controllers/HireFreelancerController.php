<?php

namespace App\Http\Controllers;

use App\Models\Freelancer;
use App\Models\HireFreelancer;
use Illuminate\Http\Request;

class HireFreelancerController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function hireFreelancer(Request $request, Freelancer $freelancer)
{
    $data = $request->validate([
        'payment_rates' => 'required|string',
        'job_description' => 'required|string',
        'job_type' => 'required|in:full-term,contract,part-time'
    ]);

    $data['employer_id'] = auth()->user()->id;
    $data['freelancer_id'] = $freelancer->id;

    HireFreelancer::create($data);

    return response()->json(['message' => 'Freelancer hired successfully']);
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
