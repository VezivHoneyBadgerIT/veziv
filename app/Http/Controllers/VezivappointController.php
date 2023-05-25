<?php

namespace App\Http\Controllers;

use App\Models\Vezivappoint;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class VezivappointController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('vezivappoints.index', [
            'vezivappoints' => Vezivappoint::all()->where("app_date",">=",strtotime(date("Y-m-d")))
        ]);
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
    public function store(Request $request)
    {
        $data = $request->validate([
            'app_date' => 'required|unique:vezivappoints,app_date',
            'full_name' => 'required|string|max:255',
            'phone'=> 'required|numeric',
            'email'=> 'required|email',
        ]);
        
        $data = $request->validate([
            'app_date' => 'required|integer|gt:'.time(),
            'full_name' => 'required|string|max:255',
            'phone'=> 'required|numeric',
            'email'=> 'required|email',
        ]);
        
        $appointment = Vezivappoint::create($data);

        return response()->json(['msg'=>'ok']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Vezivappoint $vezivappoint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vezivappoint $vezivappoint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vezivappoint $vezivappoint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vezivappoint $vezivappoint)
    {
        $this->authorize('delete', $vezivappoint);
 
        $return=$vezivappoint->delete();
        if($return)
            return redirect(route('vezivappoint.index'))->with('message',__("Appointment deleted with Success"));
        else
            return redirect(route('vezivappoint.index'))->with('message_err',__("Error in deleting appointment"));
    }
}
