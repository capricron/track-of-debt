<?php

namespace App\Http\Controllers;

use App\Models\{
    Task,
    User,               
};
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $jam = date('H');

        if( $jam > 5 && $jam < 12 ){
            $waktu =  'morning';
        }else if ($jam > 11 && $jam < 15){
            $waktu =  'afternoon';
        }else if ($jam > 14 && $jam < 18){
            $waktu =  'evening';
        }else if ( $jam > 17 && $jam > 6){
            $waktu =  'night';
        };

        return view('index', [
            'waktu' => $waktu,
            'tasks' => Task::where('user_id', auth()->id())->orderBy('tanggal', 'asc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create-task');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama' => 'required',
            'tanggal' => 'required',
            'jam' => 'required',
        ]);

        $validate['user_id'] = auth()->id();

        Task::create($validate);

        return redirect('/')->with('success', 'Berhasil menambahkan task');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function modif(Request $request)
    {
        $task = Task::find($request->id);
        return view('modif-task', [
            'task' => $task,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $validate = $request->validate([
            'nama' => 'required',
            'tanggal' => 'required',
            'jam' => 'required',
        ]);

        if($request->check == 'on'){
            $validate['checked'] = 1;
        }else{
            $validate['checked'] = 0;
        }

        $validate['user_id'] = auth()->id();

        $task->update($validate);

        return redirect('/')->with('success', 'Berhasil mengubah task');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect('/')->with('success', 'Berhasil menghapus task');
    }
}
