<?php

namespace App\Http\Controllers;

use App\Models\VezivAdmin;
use App\Models\Vezivhour;
use App\Models\Vezivappoint;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response; 
use Illuminate\View\View;
use \stdClass;

class VezivAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View 
    {
        return view('vezivadmin.index', [
            'vezivadmin' => VezivAdmin::firstOrFail()
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
    public function store(Request $request, VezivAdmin $vezivAdmin): RedirectResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(VezivAdmin $vezivAdmin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VezivAdmin $vezivAdmin): View
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VezivAdmin $vezivAdmin): RedirectResponse
    {
        $this->authorize('update', $vezivAdmin);
        $apts_enabled="0";
        if($request->has('apts_enabled'))
            $apts_enabled="1";
        $day1="0";
        if($request->has('day1'))
            $day1="1";
        $day2="0";
        if($request->has('day2'))
            $day2="1";
        $day3="0";
        if($request->has('day3'))
            $day3="1";
        $day4="0";
        if($request->has('day4'))
            $day4="1";
        $day5="0";
        if($request->has('day5'))
            $day5="1";
        $day6="0";
        if($request->has('day6'))
            $day6="1";
        $day7="0";
        if($request->has('day7'))
            $day7="1";
        $request->merge([ 'apts_enabled' => $apts_enabled, 'day1' => $day1, 'day2' => $day2, 'day3' => $day3, 'day4' => $day4, 'day5' => $day5, 'day6' => $day6, 'day7' => $day7 ]);
        $validated = $request->validate([
            'home_message' => 'required|string',
            'show_days' => 'required|string|max:2',
            'apts_enabled' => 'string|max:1',
            'day1' => 'string|max:1',
            'day2' => 'string|max:1',
            'day3' => 'string|max:1',
            'day4' => 'string|max:1',
            'day5' => 'string|max:1',
            'day6' => 'string|max:1',
            'day7' => 'string|max:1',
            'apts_disabled_message' => 'required|string',
        ]);
        $vezivAdmin=VezivAdmin::firstOrFail();
        $return=$vezivAdmin->update($validated);
        if($return)
            return redirect(route('vezivadmin.index'))->with('message',__("Settings saved with Success"));
        else
            return redirect(route('vezivadmin.index'))->with('message_err',__("Error in saving settings"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VezivAdmin $vezivAdmin)
    {
        //
    }
    public function getNextDayForAppointments($config)
    {
        $return=0;
        $current_day="day".date("N");
        $return=strtotime(date("Y-m-d 00:00:00"));
        if(isset($config->$current_day) && $config->$current_day==1)
            return $return;
        else
        {

            $days_arr=["1" => $config->day1,"2" => $config->day2,"3" => $config->day3,"4" => $config->day4,"5" => $config->day5,"6" => $config->day6,"7" => $config->day7];
            $have_something=0;
            foreach($days_arr as $day => $enabled)
            {
                if($enabled==1)
                    $have_something=1;
            }
            if($have_something==0)
                return 0;
            $found_day=0;
            $stamp=$return;
            while($found_day==0)
            {
                $stamp=strtotime(date("Y-m-d 00:00:00",$stamp)." +1 day");
                $next_day=date("N",$stamp);
                if(isset($days_arr[$next_day]) && $days_arr[$next_day]==1)
                {
                    $return=$stamp;
                    $found_day=1;
                }
            }
        }

        return $return;
    }
    public function getAppointments()
    {
        $appointments=new stdClass();
        $appointments->current_day=0;
        $config=VezivAdmin::firstOrFail();
        if($config->apts_enabled==0 || $config->show_days<=0)
            return $appointments;
        $appointments->current_day=$this->getNextDayForAppointments($config);
        $appointments->current_day_str=date("d/m/Y H:i:s",$appointments->current_day);
        $appointments->hours=Vezivhour::orderBy('start_time','ASC')->get();
        $appointments->days=array();
        $active_appointments=Vezivappoint::all()->where("app_date",">=",strtotime(date("Y-m-d")));
        $disabled_today=array();
        foreach($appointments->hours as $hour)
        {
            if(time()>=strtotime(date("Y-m-d",$appointments->current_day)." ".$hour->start_time))
                $disabled_today[]=$hour->start_time;
        }
        $appointments->days[strtotime(date("Y-m-d 00:00:00",$appointments->current_day))]=$disabled_today;
        for($i=1;$i<$config->show_days;$i++)
        {
            $disabled_hours=array();
            $next_day_stamp=strtotime(date("Y-m-d 00:00:00",$appointments->current_day)." +".$i." day");
            foreach($active_appointments as $app_stamp)
            {
                if(strtotime(date("Y-m-d",$app_stamp->app_date)) == $next_day_stamp)
                    $disabled_hours[]=date("H:i",$app_stamp->app_date);
            }
            $appointments->days[$next_day_stamp]=$disabled_hours;
        }
        return $appointments;
    }
}
