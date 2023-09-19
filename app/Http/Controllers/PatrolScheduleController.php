<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Patrol;
use App\Models\PatrolSchedule;
use App\Models\PatrolTask;
use App\Models\PersonilScheduling;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PatrolScheduleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $Patrol = Patrol::where('data_state', 0)->get();
        return view('content/PatrolSchedule/ListPatrolSchedule', compact('Patrol'));
    }

    public function screenTambah()
    {
        if (!Session::get('patrol_name')) {
            $patrol_name = '';
        } else {
            $patrol_name = Session::get('patrol_name');
        }

        if (!Session::get('JadwalPatroli')) {
            $JadwalPatroli = [];
        } else {
            $JadwalPatroli = Session::get('JadwalPatroli');
        }

        if (!Session::get('task')) {
            $task = [];
        } else {
            $task = Session::get('task');
        }

        $patrol_schedule = PatrolSchedule::where('data_state', 0)->get();
        $location = Location::where('data_state', 0)->get();
        return view('content/PatrolSchedule/TambahPatrolSchedule', compact('patrol_schedule', 'location', 'task', 'patrol_name', 'JadwalPatroli'));
    }

    public function jadwal(Request $request)
    {
        $patrolName = $request->patrol_name;
        Session::put('patrol_name', $patrolName);
        return redirect('/patrol-schedule/tambah');
    }

    public function sessionList(Request $request)
    {
        $request->validate([
            'location_id' => 'required',
            'patrol_start_time' => 'required',
            'patrol_end_time' => 'required',
            'patrol_information' => 'required',
        ]);

        $patrol_task = PatrolTask::where('patrol_task_id', $request->patrol_task_id)->first();
        $patrol_schedule = array(
            'patrol_task' => $patrol_task['patrol_task'],
        );

        $lastdataPatrolSchedule = Session::get('listPatrolSchedule');
        if ($lastdataPatrolSchedule !== null) {
            array_push($lastdataPatrolSchedule, $patrol_schedule);
            Session::put('listPatrolSchedule', $lastdataPatrolSchedule);
        } else {
            $lastdataPatrolSchedule = [];
            array_push($lastdataPatrolSchedule, $patrol_schedule);
            Session::push('listPatrolSchedule', $patrol_schedule);
        }

        return redirect('/patrol-schedule/tambah');
    }

    public function tambah()
    {
        if (Session::get('patrol_name') && Session::get('JadwalPatroli') && Session::get('task')) {
            $patrol_name = Session::get('patrol_name');
            $patrol = [
                'patrol_name' => $patrol_name,
            ];
            Patrol::create($patrol);
            $getPatrol = Patrol::where('data_state', 0)->where('patrol_name', $patrol_name)->orderBy('patrol_id', 'desc')->first();
            $patrol_id = $getPatrol->patrol_id;

            $JadwalPatroli = Session::get('JadwalPatroli');
            foreach ($JadwalPatroli as $JadwalPatrolis) {
                $patrol_schedule = [
                    'patrol_id' => $patrol_id,
                    'location_id' => $JadwalPatrolis['location_id'],
                    'patrol_start_time' => $JadwalPatrolis['patrol_start_time'],
                    'patrol_end_time' => $JadwalPatrolis['patrol_end_time'],
                    'patrol_information' => $JadwalPatrolis['patrol_information'],
                ];
                PatrolSchedule::create($patrol_schedule);
            }
            $task = Session::get('task');
            foreach ($task as $tasks) {
                $patrol_task = [
                    'patrol_id' => $patrol_id,
                    'task' => $tasks['task'],
                ];
                PatrolTask::create($patrol_task);
            }
            Session::forget('patrol_name');
            Session::forget('JadwalPatroli');
            Session::forget('task');
            return redirect()->to('/patrol-schedule')->with('msg', 'Tambah Jadwal Patroli Sukses');
        } else {
            return redirect()->to('/patrol-schedule/tambah')->with('msg', 'Tidak boleh kosong!');
        }
    }


    public function update(Request $request, $patrol_id)
    {
        $patrol = [
            'patrol_name' => $request->patrol_name,
        ];
        Patrol::where('patrol_id', $patrol_id)->update($patrol);


        $PatrolSchedule = PatrolSchedule::where('data_state', 0)->where('patrol_id', $patrol_id)->get();
        for ($i = 1; $i < count($PatrolSchedule) + 1; $i++) {
            $reqlocation_id = 'location_id' . $i;
            $reqpatrol_start_time = 'patrol_start_time' . $i;
            $reqpatrol_end_time = 'patrol_end_time' . $i;
            $reqpatrol_information = 'patrol_information' . $i;
            $PatrolScheduleToUpdate = $PatrolSchedule[$i - 1];
            $PatrolScheduleToUpdate->update([
                'location_id' => $request->$reqlocation_id,
                'patrol_start_time' => $request->$reqpatrol_start_time,
                'patrol_end_time' => $request->$reqpatrol_end_time,
                'patrol_information' => $request->$reqpatrol_information,
            ]);
        }

        $jadwalPatroliEdit = Session::get('jadwalPatroliEdit');
        if ($jadwalPatroliEdit != null) {
            foreach ($jadwalPatroliEdit as $jadwalPatroliEdits) {
                $patrol_schedule = [
                    'patrol_id' => $patrol_id,
                    'location_id' => $jadwalPatroliEdits['location_id'],
                    'patrol_start_time' => $jadwalPatroliEdits['patrol_start_time'],
                    'patrol_end_time' => $jadwalPatroliEdits['patrol_end_time'],
                    'patrol_information' => $jadwalPatroliEdits['patrol_information'],
                ];
                PatrolSchedule::create($patrol_schedule);
            }
        }

        
        $task = PatrolTask::where('data_state', 0)->where('patrol_id', $patrol_id)->get();
        for ($i = 1; $i < count($task) + 1; $i++) {
            $reqTask = 'task' . $i;
            $taskToUpdate = $task[$i - 1];
            $taskToUpdate->update([
                'task' => $request->$reqTask,
            ]);
        }
        
        $taskEdit = Session::get('taskEdit');
        if ($taskEdit != null) {
            foreach ($taskEdit as $taskEdits) {
                $patrol_task = [
                    'patrol_id' => $patrol_id,
                    'task' => $taskEdits['task'],
                ];
                PatrolTask::create($patrol_task);
            }
        }
        
        Session::forget('jadwalPatroliEdit');
        Session::forget('taskEdit');
        return redirect()->to('/patrol-schedule')->with('msg', 'Edit Jadwal Sukses');
    }
    
    public function edit($patrol_id)
    {
        if (!Session::get('jadwalPatroliEdit')) {
            $jadwalPatroliEdit = [];
        } else {
            $jadwalPatroliEdit = Session::get('jadwalPatroliEdit');
        }
        if (!Session::get('taskEdit')) {
            $taskEdit = [];
        } else {
            $taskEdit = Session::get('taskEdit');
        }
        $patrol = Patrol::where('data_state', 0)->where('patrol_id', $patrol_id)->first();
        $patrol_schedule = PatrolSchedule::where('data_state', 0)->where('patrol_id', $patrol_id)->get();
        $location = Location::where('data_state', 0)->get();
        $task = PatrolTask::where('data_state', 0)->where('patrol_id', $patrol_id)->get();
        return view('content/PatrolSchedule/EditPatrolSchedule', compact('patrol', 'taskEdit', 'task', 'location', 'patrol_schedule', 'jadwalPatroliEdit'));
    }

    public function detail($patrol_id)
    {
        $patrol = Patrol::where('data_state', 0)->where('patrol_id', $patrol_id)->first();
        $patrol_schedule = PatrolSchedule::where('data_state', 0)->where('patrol_id', $patrol_id)->get();
        $patrol_task = PatrolTask::where('data_state', 0)->where('patrol_id', $patrol_id)->get();
        return view('content/PatrolSchedule/DetailPatrolSchedule', compact('patrol', 'patrol_schedule', 'patrol_task'));
    }

    public function delete($patrol_id)
    {
        $data_state = ['data_state' => 1];
        Patrol::where('patrol_id', $patrol_id)->update($data_state);
        PatrolTask::where('patrol_id', $patrol_id)->update($data_state);
        PatrolSchedule::where('patrol_id', $patrol_id)->update($data_state);
        return redirect()->to('/patrol-schedule');
    }


    public function JadwalPatroliSession(Request $request)
    {
        $request->validate([
            'location_id' => ['required'],
            'patrol_start_time' => ['required'],
            'patrol_end_time' => ['required'],
            'patrol_information' => ['required'],
        ]);
        $location = Location::where('data_state', 0)->where('location_id', $request->location_id)->first();

        $lastJadwalPatroli = Session::get('JadwalPatroli');
        if ($lastJadwalPatroli != null) {
            $lastIndexJadwalPatroli = collect($lastJadwalPatroli)->sortByDesc('index')->first();
            $JadwalPatroli = [
                'index' => $lastIndexJadwalPatroli['index'] + 1,
                'location_name' => $location->location_name,
                'location_id' => $request->location_id,
                'patrol_start_time' => $request->patrol_start_time,
                'patrol_end_time' => $request->patrol_end_time,
                'patrol_information' => $request->patrol_information,
            ];
            array_push($lastJadwalPatroli, $JadwalPatroli);
            Session::put('JadwalPatroli', $lastJadwalPatroli);
        } else {
            $JadwalPatroli = [
                'index' => 0,
                'location_name' => $location->location_name,
                'location_id' => $request->location_id,
                'patrol_start_time' => $request->patrol_start_time,
                'patrol_end_time' => $request->patrol_end_time,
                'patrol_information' => $request->patrol_information,
            ];
            Session::push('JadwalPatroli', $JadwalPatroli);
        }
    }

    public function taskSession(Request $request)
    {
        $request->validate([
            'task' => ['required'],
        ]);

        $lastTask = Session::get('task');
        if ($lastTask != null) {
            $lastIndex = collect($lastTask)->sortByDesc('index')->first();
            $task = [
                'index' => $lastIndex['index'] + 1,
                'task' => $request->task,
            ];
            array_push($lastTask, $task);
            Session::put('task', $lastTask);
        } else {
            $task = [
                'index' => 0,
                'task' => $request->task,
            ];
            Session::push('task', $task);
        }
    }

    public function editTaskSession(Request $request)
    {
        $request->validate([
            'task' => ['required'],
        ]);

        $lastTask = Session::get('taskEdit');
        if ($lastTask != null) {
            $lastIndex = collect($lastTask)->sortByDesc('index')->first();
            $task = [
                'index' => $lastIndex['index'] + 1,
                'task' => $request->task,
            ];
            array_push($lastTask, $task);
            Session::put('taskEdit', $lastTask);
        } else {
            $task = [
                'index' => 0,
                'task' => $request->task,
            ];
            Session::push('taskEdit', $task);
        }
    }

    public function editJadwalPatroliSession(Request $request)
    {
        $request->validate([
            'location_id' => ['required'],
            'patrol_start_time' => ['required'],
            'patrol_end_time' => ['required'],
            'patrol_information' => ['required'],
        ]);

        $lastJadwalPatroli = Session::get('jadwalPatroliEdit');
        if ($lastJadwalPatroli != null) {
            $lastIndex = collect($lastJadwalPatroli)->sortByDesc('index')->first();
            $jadwalPatroli = [
                'index' => $lastIndex['index'] + 1,
                'location_id' => $request->location_id,
                'patrol_start_time' => $request->patrol_start_time,
                'patrol_end_time' => $request->patrol_end_time,
                'patrol_information' => $request->patrol_information,
            ];
            array_push($lastJadwalPatroli, $jadwalPatroli);
            Session::put('jadwalPatroliEdit', $lastJadwalPatroli);
        } else {
            $jadwalPatroli = [
                'index' => 0,
                'location_id' => $request->location_id,
                'patrol_start_time' => $request->patrol_start_time,
                'patrol_end_time' => $request->patrol_end_time,
                'patrol_information' => $request->patrol_information,
            ];
            Session::push('jadwalPatroliEdit', $jadwalPatroli);
        }
    }

    public function deleteJadwalPatroli($index)
    {
        $JadwalPatroli = Session::get('JadwalPatroli');
        unset($JadwalPatroli[$index]);
        Session::put('JadwalPatroli', $JadwalPatroli);
        return redirect()->to('/patrol-schedule/tambah');
    }

    public function deleteTask($index)
    {
        $task = Session::get('task');
        unset($task[$index]);
        Session::put('task', $task);
        return redirect()->to('/patrol-schedule/tambah');
    }

    public function editDeleteTask($patrol_id, $patrol_task_id)
    {
        $data_state = ['data_state' => 1];
        PatrolTask::where('patrol_task_id', $patrol_task_id)->update($data_state);
        return redirect()->to('/patrol-schedule/edit/' . $patrol_id);
    }

    public function editDeleteJadwalPatroli($patrol_id, $patrol_schedule_id)
    {
        $data_state = ['data_state' => 1];
        PatrolSchedule::where('patrol_schedule_id', $patrol_schedule_id)->update($data_state);
        return redirect()->to('/patrol-schedule/edit/' . $patrol_id);
    }

    public function editDeleteTaskSession($patrol_id, $index)
    {
        $task = Session::get('taskEdit');
        unset($task[$index]);
        Session::put('taskEdit', $task);
        return redirect()->to('/patrol-schedule/edit/' . $patrol_id);
    }

    public function editDeleteJadwalPatroliSession($patrol_id, $index)
    {
        $jadwalPatroliEdit = Session::get('jadwalPatroliEdit');
        unset($jadwalPatroliEdit[$index]);
        Session::put('jadwalPatroliEdit', $jadwalPatroliEdit);
        return redirect()->to('/patrol-schedule/edit/' . $patrol_id);
    }
    
    public function PatrolMapping($patrol_id)
    {
        return view('content/PatrolSchedule/PatrolMapping', compact('patrol_id'));
    }

    public function getMarkers(Request $request)
    {
        $markers = DB::table('patrol_schedule')
            ->where('patrol_schedule.data_state', 0)
            ->where('patrol_schedule.patrol_id', $request->patrol_id)
            ->join('location', 'patrol_schedule.location_id', '=', 'location.location_id')
            ->select('patrol_schedule.patrol_start_time', 'patrol_schedule.patrol_end_time', 'location.location_name', 'location.latitude', 'location.longitude')
            ->orderBy('patrol_schedule.patrol_start_time')
            ->get();
        return response()->json($markers);
    }
}