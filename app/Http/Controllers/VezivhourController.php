<?php

namespace App\Http\Controllers;

use App\Models\Vezivhour;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class VezivhourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('vezivhours.index', [
            'vezivhours' => Vezivhour::orderBy('start_time','ASC')->get()
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
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'start_time' => 'date_format:H:i',
            'end_time' => 'date_format:H:i',
        ]);
        $start_time=$request->start_time;
        $end_time=$request->end_time;
        $all_times=Vezivhour::all();
        if($all_times->count()>0)
        {
            foreach($all_times as $time)
            {
                if($time->start_time==$start_time)
                    return redirect(route('vezivhours.index'))->with('message_err',__("Starting time already exists"));
                if($start_time>$time->start_time && $start_time<$time->end_time)
                    return redirect(route('vezivhours.index'))->with('message_err',__("Starting time overlaps an existing time").": ".$time->start_time." - ".$time->end_time);
                if($end_time>$time->start_time && $end_time<$time->end_time)
                    return redirect(route('vezivhours.index'))->with('message_err',__("Starting time overlaps an existing time").": ".$time->start_time." - ".$time->end_time);
            }
        }
        $return=$request->user()->vezivhours()->create($validated);
        if($return)
            return redirect(route('vezivhours.index'))->with('message',__("Appointment hour saved with Success"));
        else
            return redirect(route('vezivhours.index'))->with('message_err',__("Error in saving appointment hour"));
    }

    /**
     * Display the specified resource.
     */
    public function show(Vezivhour $vezivhour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vezivhour $vezivhour): View
    {
        $this->authorize('update', $vezivhour);

        return view('vezivhours.edit', [
            'vezivhour' => $vezivhour,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vezivhour $vezivhour): RedirectResponse
    {
        $this->authorize('update', $vezivhour);

        $validated = $request->validate([
            'start_time' => 'date_format:H:i',
            'end_time' => 'date_format:H:i',
        ]);

        $time_edit_id=$vezivhour->id;
        $start_time=$request->start_time;
        $end_time=$request->end_time;
        $all_times=$vezivhour->all();
        if($all_times->count()>0)
        {
            foreach($all_times as $time)
            {
                if($time->id==$time_edit_id)
                    continue;
                if($time->start_time==$start_time)
                    return redirect(route('vezivhours.index'))->with('message_err',__("Starting time already exists"));
                if($start_time>$time->start_time && $start_time<$time->end_time)
                    return redirect(route('vezivhours.index'))->with('message_err',__("Starting time overlaps an existing time").": ".$time->start_time." - ".$time->end_time);
                if($end_time>$time->start_time && $end_time<$time->end_time)
                    return redirect(route('vezivhours.index'))->with('message_err',__("Starting time overlaps an existing time").": ".$time->start_time." - ".$time->end_time);
            }
        }

        $return=$vezivhour->update($validated);
        if($return)
            return redirect(route('vezivhours.index'))->with('message',__("Appointment hour updated with Success"));
        else
            return redirect(route('vezivhours.index'))->with('message_err',__("Error in updating appointment hour"));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vezivhour $vezivhour)
    {
        $this->authorize('delete', $vezivhour);
 
        $return=$vezivhour->delete();
        if($return)
            return redirect(route('vezivhours.index'))->with('message',__("Appointment hour deleted with Success"));
        else
            return redirect(route('vezivhours.index'))->with('message_err',__("Error in deleting appointment hour"));
    }
}
