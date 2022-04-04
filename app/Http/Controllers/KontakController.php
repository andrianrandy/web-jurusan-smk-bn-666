<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kontak;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class KontakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          if(Auth::user()->is_admin != 1) {
            abort(403);
        }
       $kontak = Kontak::all();
        return view('backend.kontak.index', [
            'kontak' => $kontak
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          if(Auth::user()->is_admin != 1) {
            abort(403);
        }
         return view('backend.kontak.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          if(Auth::user()->is_admin != 1) {
            abort(403);
        }
         $this->validate($request, [
            'link' => 'required',
        ]);

        $social = Kontak::create([
            'link' => $request->link,
        ]);

        Alert::success('Berhasil', 'Data berhasil tersimpan');
        return redirect()->route('kontak.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          if(Auth::user()->is_admin != 1) {
            abort(403);
        }
        $kontak = Kontak::find($id);

        return view('backend.kontak.edit', [
            'kontak' => $kontak
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
          if(Auth::user()->is_admin != 1) {
            abort(403);
        }
        $data = $request->all();
        $kontak = Kontak::findOrFail($id);
        $kontak->update($data);

        Alert::info('Update', 'Data berhasil terupdate');
         return redirect()->route('kontak.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          if(Auth::user()->is_admin != 1) {
            abort(403);
        }
        $kontak = Kontak::find($id);

        $kontak->delete();

        Alert::warning('Hapus', 'Data berhasil terhapus');
        return redirect()->route('kontak.index');
    }
}
