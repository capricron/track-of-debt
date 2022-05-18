<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Debt;

class MbuhController extends Controller
{
    
    public function updates(Request $request)
    {
        // return $request->all();
        $validate = $request->validate([
            'nama' => 'required',
            'tanggal' => 'required',
            'jumlah' => 'required',
            'noKtp' => 'required',
            'phone' => 'required',
            'deskripsi' => 'required',
            'alamat' => 'required',
        ]);

        // return $validate;
        $validate['user_id'] = auth()->id();

        Debt::where('id', $request->id)->update($validate);

        return redirect('../')->with('success', 'Berhasil mengubah Debt');
    }

    public function destroy(Request $request)
    {
        Debt::destroy($request->id);

        return redirect('/')->with('success', 'Berhasil menghapus Debt');
    }
}
