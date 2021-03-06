<?php

namespace App\Http\Controllers;

use App\Models\{
    Debt,
    User,               
};
use Illuminate\Http\Request;

class DebtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index', [
            'debts' => Debt::where('user_id', auth()->id())->orderBy('tanggal', 'asc')->get(),
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
            'jumlah' => 'required',
            'noKtp' => 'required|max:16',
            'phone' => 'required|max:11',
            'deskripsi' => 'required',
            'alamat' => 'required',
        ]);

        $validate['user_id'] = auth()->id();

        Debt::create($validate);

        return redirect('/')->with('success', 'Berhasil menambahkan Debt');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Debt  $Debt
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Debt::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Debt  $Debt
     * @return \Illuminate\Http\Response
     */
    public function modif(Request $request)
    {
        $Debt = Debt::find($request->id);
        return view('modif-debt', [
            'debt' => $Debt,
        ]);
    }

    
    public function checked(Request $request)
    {
        // return $request->check;
        $Debt = Debt::find($request->id);
        $Debt->checked = $request->check;
        $Debt->save();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Debt  $Debt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Debt  $Debt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return $request->all();
        // Debt::destroy($request->id);
        $debt = Debt::find('id',$request->id);
        return $debt->get();

        return redirect('/')->with('success', 'Berhasil menghapus Debt');
    }
}
