<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class SchedulesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $days_of_week =  [

            1 =>
                [
                    0 => 'Segunda',
                    1 => Schedule::where('week_day', 1)->where('status', true)->exists(),
                    2 => Schedule::where('week_day', 1)->where('status', true)->get(),
                    3 => Schedule::where('week_day', 1)->orderBy('start_time', 'ASC')->get(),
                ],
            2 =>
                [
                    0 => 'Terça',
                    1 => Schedule::where('week_day', 2)->where('status', true)->exists(),
                    2 => Schedule::where('week_day', 2)->where('status', true)->get(),
                    3 => Schedule::where('week_day', 2)->orderBy('start_time', 'ASC')->get(),
                ],
            3 =>
                [
                    0 => 'Quarta',
                    1 => Schedule::where('week_day', 3)->where('status', true)->exists(),
                    2 => Schedule::where('week_day', 3)->where('status', true)->get(),
                    3 => Schedule::where('week_day', 3)->orderBy('start_time', 'ASC')->get(),
                ],
            4 =>
                [
                    0 => 'Quinta',
                    1 => Schedule::where('week_day', 4)->where('status', true)->exists(),
                    2 => Schedule::where('week_day', 4)->where('status', true)->get(),
                    3 => Schedule::where('week_day', 4)->orderBy('start_time', 'ASC')->get(),
                ],
            5 =>
                [
                    0 => 'Sexta',
                    1 => Schedule::where('week_day', 5)->where('status', true)->exists(),
                    2 => Schedule::where('week_day', 5)->where('status', true)->get(),
                    3 => Schedule::where('week_day', 5)->orderBy('start_time', 'ASC')->get(),
                ],
            6 =>
                [
                    0 => 'Sábado',
                    1 => Schedule::where('week_day', 6)->where('status', true)->exists(),
                    2 => Schedule::where('week_day', 6)->where('status', true)->get(),
                    3 => Schedule::where('week_day', 6)->orderBy('start_time', 'ASC')->get(),
                ],
            7 =>
                [
                    0 => 'Domingo',
                    1 => Schedule::where('week_day', 0)->where('status', true)->exists(),
                    2 => Schedule::where('week_day', 0)->where('status', true)->get(),
                    3 => Schedule::where('week_day', 0)->orderBy('start_time', 'ASC')->get(),
                ]
        ];

        return view('admin.schedule.index' ,compact('days_of_week'));
    }

    public function layout(Request $request)
    {
        $schedule_to_delete = Schedule::get();
        foreach ($schedule_to_delete as $schedule_to_del){
            Schedule::destroy($schedule_to_del->id);
        }
        if(!empty($request->get('layout_id_modal'))){
            switch ($request->get('layout_id_modal')){
                case 1:
                    $days = range(2, 6);
                    foreach($days as $day){
                        $schedule = new Schedule();
                        $schedule->week_day = $day;
                        $schedule->start_time = '09:00';
                        $schedule->end_time = '12:00';
                        $schedule->status = true;
                        $schedule->save();
                    }
                    foreach($days as $day){
                        $schedule = new Schedule();
                        $schedule->week_day = $day;
                        $schedule->start_time = '14:00';
                        $schedule->end_time = '18:00';
                        $schedule->status = true;
                        $schedule->save();
                    }
                    break;
                case 2:
                    $days = range(2, 6);
                    foreach($days as $day){
                        $schedule = new Schedule();
                        $schedule->week_day = $day;
                        $schedule->start_time = '09:00';
                        $schedule->end_time = '18:00';
                        $schedule->status = true;
                        $schedule->save();
                    }
                    break;
                case 3:
                    $days = range(2, 6);
                    foreach($days as $day){
                        $schedule = new Schedule();
                        $schedule->week_day = $day;
                        $schedule->start_time = '00:00';
                        $schedule->end_time = '23:59';
                        $schedule->status = true;
                        $schedule->save();
                    }
                    break;
                case 4:
                    $days = range(0, 6);
                    foreach($days as $day){
                        $schedule = new Schedule();
                        $schedule->week_day = $day;
                        $schedule->start_time = '09:00';
                        $schedule->end_time = '12:00';
                        $schedule->status = true;
                        $schedule->save();
                    }
                    foreach($days as $day){
                        $schedule = new Schedule();
                        $schedule->week_day = $day;
                        $schedule->start_time = '14:00';
                        $schedule->end_time = '18:00';
                        $schedule->status = true;
                        $schedule->save();
                    }
                    break;
                case 5:
                    $days = range(0, 6);
                    foreach($days as $day){
                        $schedule = new Schedule();
                        $schedule->week_day = $day;
                        $schedule->start_time = '09:00';
                        $schedule->end_time = '18:00';
                        $schedule->status = true;
                        $schedule->save();
                    }
                    break;
                case 6:
                    $days = range(0, 6);
                    foreach($days as $day){
                        $schedule = new Schedule();
                        $schedule->week_day = $day;
                        $schedule->start_time = '00:00';
                        $schedule->end_time = '23:59';
                        $schedule->status = true;
                        $schedule->save();
                    }
                    break;
                case 7:
                    $days = range(5, 6);
                    foreach($days as $day){
                        $schedule = new Schedule();
                        $schedule->week_day = $day;
                        $schedule->start_time = '09:00';
                        $schedule->end_time = '12:00';
                        $schedule->status = true;
                        $schedule->save();
                    }
                    foreach($days as $day){
                        $schedule = new Schedule();
                        $schedule->week_day = $day;
                        $schedule->start_time = '14:00';
                        $schedule->end_time = '18:00';
                        $schedule->status = true;
                        $schedule->save();
                    }
                    break;
                case 8:
                    $days = range(5, 6);
                    foreach($days as $day){
                        $schedule = new Schedule();
                        $schedule->week_day = $day;
                        $schedule->start_time = '09:00';
                        $schedule->end_time = '18:00';
                        $schedule->status = true;
                        $schedule->save();
                    }
                    break;
                case 9:
                    $days = range(5, 6);
                    foreach($days as $day){
                        $schedule = new Schedule();
                        $schedule->week_day = $day;
                        $schedule->start_time = '00:00';
                        $schedule->end_time = '23:59';
                        $schedule->status = true;
                        $schedule->save();
                    }
                    break;
                case 10:
                    $days = range(1, 5);
                    foreach($days as $day){
                        $schedule = new Schedule();
                        $schedule->week_day = $day;
                        $schedule->start_time = '09:00';
                        $schedule->end_time = '12:00';
                        $schedule->status = true;
                        $schedule->save();
                    }
                    foreach($days as $day){
                        $schedule = new Schedule();
                        $schedule->week_day = $day;
                        $schedule->start_time = '14:00';
                        $schedule->end_time = '18:00';
                        $schedule->status = true;
                        $schedule->save();
                    }
                    break;
                case 11:
                    $days = range(1, 5);
                    foreach($days as $day){
                        $schedule = new Schedule();
                        $schedule->week_day = $day;
                        $schedule->start_time = '09:00';
                        $schedule->end_time = '18:00';
                        $schedule->status = true;
                        $schedule->save();
                    }
                    break;
                case 12:
                    $days = range(1, 5);
                    foreach($days as $day){
                        $schedule = new Schedule();
                        $schedule->week_day = $day;
                        $schedule->start_time = '00:00';
                        $schedule->end_time = '23:59';
                        $schedule->status = true;
                        $schedule->save();
                    }
                    break;
                case 13:
                    $days = range(1, 6);
                    foreach($days as $day){
                        $schedule = new Schedule();
                        $schedule->week_day = $day;
                        $schedule->start_time = '09:00';
                        $schedule->end_time = '12:00';
                        $schedule->status = true;
                        $schedule->save();
                    }
                    foreach($days as $day){
                        $schedule = new Schedule();
                        $schedule->week_day = $day;
                        $schedule->start_time = '14:00';
                        $schedule->end_time = '18:00';
                        $schedule->status = true;
                        $schedule->save();
                    }
                    break;
                case 14:
                    $days = range(1, 6);
                    foreach($days as $day){
                        $schedule = new Schedule();
                        $schedule->week_day = $day;
                        $schedule->start_time = '09:00';
                        $schedule->end_time = '18:00';
                        $schedule->status = true;
                        $schedule->save();
                    }
                    break;
                case 15:
                    $days = range(1, 6);
                    foreach($days as $day){
                        $schedule = new Schedule();
                        $schedule->week_day = $day;
                        $schedule->start_time = '00:00';
                        $schedule->end_time = '23:59';
                        $schedule->status = true;
                        $schedule->save();
                    }
                    break;
            }
        }
        return redirect(route('admin-schedule-index'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function changeVisibility($day)
    {
        if(Schedule::where('week_day', $day)->exists()){
            if(Schedule::where('week_day', $day)->where('status', true)->exists()) {
                $schedules = Schedule::where('week_day', $day)->get();
                foreach ($schedules as $schedule) {
                    $sched = Schedule::find($schedule->id);
                    $sched->status = false;
                    $sched->save();
                }
            }else{
                $schedules = Schedule::where('week_day', $day)->get();
                foreach ($schedules as $schedule) {
                    $sched = Schedule::find($schedule->id);
                    $sched->status = true;
                    $sched->save();
                }
            }
            return redirect(route('admin-schedule-index'));
        }else{
            return redirect(route('admin-schedule-index'))->with('no_shedule', 'Nenhum agendamento para este dia.');
        }
    }
    public function changeVisibilitySchedule($id)
    {
        $schedule = Schedule::find($id);
        if($schedule->status == true){
            $schedule->status = false;
        }else{
            $schedule->status = true;
        }
        $schedule->save();
        return redirect(route('admin-schedule-index'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $start_time = $request->get('start_time');
        $end_time = $request->get('end_time');
        $start_time_integer = str_replace(' : ', '', $request->get('start_time'));
        $end_time_integer = str_replace(' : ', '', $request->get('end_time'));

        if($start_time_integer>$end_time_integer){
            return redirect(route('admin-schedule-index'))->with('logic_error_'.$request->get('week_day'), 'O valor do começo do horário deve menor que o final do horário.');
        }
        if($start_time_integer == $end_time_integer){
            return redirect(route('admin-schedule-index'))->with('logic_error_'.$request->get('week_day'), 'Os horários não podem ser iguais.');
        }

        $schedule = new Schedule();
        $schedule->week_day = $request->get('week_day');
        $schedule->start_time = $start_time;
        $schedule->end_time = $end_time;
        $schedule->status = true;
        $schedule->save();
        return redirect(route('admin-schedule-index'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {
        $start_time = $request->get('start_time');
        $end_time = $request->get('end_time');
        $start_time_integer = str_replace(':', '', $request->get('start_time'));
        $end_time_integer = str_replace(':', '', $request->get('end_time'));

        if($start_time_integer>$end_time_integer){
            return redirect(route('admin-schedule-index'))->with('logic_error_'.$request->get('week_day'), 'O valor do começo do horário deve menor que o final do horário.');
        }
        if($start_time_integer == $end_time_integer){
            return redirect(route('admin-schedule-index'))->with('logic_error_'.$request->get('week_day'), 'Os horários não podem ser iguais.');
        }

        $schedule = Schedule::find($request->get('id'));
        $schedule->start_time = $start_time;
        $schedule->end_time = $end_time;
        $schedule->save();
        return redirect(route('admin-schedule-index'));
    }

    public function delete($id = null)
    {
        $schedule = Schedule::first();
        $schedule->delete();
        return redirect(route('admin-schedule-index'));
    }
}
