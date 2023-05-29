<?php

namespace App\Http\Controllers;

use App\Models\Locations;
use App\Http\Requests\StoreLocationsRequest;
use App\Http\Requests\UpdateLocationsRequest;

class LocationsController extends Controller
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

    public function byCategory(String $category)
    {
        $locations = Locations::where("categoria", $category)->get();
        $data = [
            'message' => "Detalles del empleado",
            'data' => $locations,
        ];
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Locations $locations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Locations $locations)
    {
        //
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Locations $locations)
    {
        //
    }
}
