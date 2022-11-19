<?php

namespace App\Http\Controllers;

use App\Models\Patients;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;

class PatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Patients::all();
        $data =        
        [
            "status_code" => 200,
            "message" => "The request succeeded",
            "data" => $query
        ];

        return new Response($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $query = Patients::create([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'status' => $request->input('status'),
            'in_date_at' => now(),
        ]);

        $data =        
        [
            "status_code" => 201,
            "message" => "Resource created",
            "data" => $query
        ];

        return new Response($data, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patients  $patients
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $query = Patients::find($id);
        if ($query == null){
            $data = [
                "status_code" => 404,
                "message" => "Resource not found",
                "data" => $query
            ];
            return new Response($data, 404);
        }else{
            $data = [
                "status_code" => 200,
                "message" => "The request succeeded",
                "data" => $query
            ];
            return new Response($data, 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patients  $patients
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request ,$id)
    {
        $query = Patients::find($id);
        if ($query == null){
            $data = [
                "status_code" => 404,
                "message" => "Resource not found",
                "data" => $query
            ];
            return new Response($data, 404);
        }else{
            // $query->updated([
            //     'name' => $request->input('name'),
            //     'phone' => $request->input('phone'),
            //     'address' => $request->input('address'),
            //     'status' => $request->input('status'),
            //     'out_date_at' => now()
            // ]);
            $query->update([
                $request->all(),
                "out_date_at" => now(),
            ]);

            $data = [
                "status_code" => 201,
                "message" => "Resource updated",
                "data" => $query
            ];
            return new Response($data, 201);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patients  $patients
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $query = Patients::find($id);
        if ($query == null){
            $data = [
                "status_code" => 404,
                "message" => "Resource not found",
                "data" => $query
            ];
            return new Response($data, 404);
        }else{
            $query->delete();
            $data = [
                "status_code" => 201,
                "message" => "The request deleted",
                "data" => $query
            ];
            return new Response($data, 201);
        }
    }
}
