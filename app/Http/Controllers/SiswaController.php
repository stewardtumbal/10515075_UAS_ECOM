<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index(){
    	$data['result'] = \App\Siswa::all();
    	return view('siswa/index')->with($data);
    }

    public function create(){
    	return view('siswa/form');
    }

    public function store(Request $request){
    	$rules = [
    		'nis' => 'required|unique:t_siswa',
    		'nama_lengkap' => 'required|max:100',
    		'jenis_kelamin' => 'required',
    		'alamat' => 'required',
    		'no_telp' => 'required',
    		'id_kelas' => 'required|exists:t_kelas',
    		'foto' => 'required|mimes:jpeg,jpg,png|max:512'
    	];
    	$this->validate($request, $rules);

    	$input = $request->all();

    	if($request->hasFile('foto') && $request->file('foto')->isValid()){
    		$filename = $input['nis']. "." .$request->file('foto')->getClientOriginalExtension();
    		$request->file('foto')->storeAs('', $filename);
    		$input['foto'] = $filename;
    		$pic = $request->file('foto');
    		$pic->move(public_path().'/uploads/', $filename);
    	}

    	$status = \App\Siswa::create($input);

    	if ($status) return redirect('siswa')->with('success', 'Data Berhasil Ditambahkan');
    	else return redirect('siswa')->with('error', 'Data Gagal Ditambahkan');
    }

    public function edit($id){
    	$data['result'] = \App\Siswa::where('nis', $id)->first();
    	return view('siswa/form')->with($data);
    }

    public function update(Request $request, $id){
    	$rules = [
    		'nama_lengkap' => 'required|max:100',
    		'jenis_kelamin' => 'required',
    		'alamat' => 'required',
    		'no_telp' => 'required',
    		'id_kelas' => 'required|exists:t_kelas',
    		'foto' => 'required|mimes:jpeg,jpg,png|max:512'
    	];
    	$this->validate($request, $rules);

    	$input = $request->all();

    	if($request->hasFile('foto') && $request->file('foto')->isValid()){
    		$filename = $input['nis'].".".$request->file('foto')->getClientOriginalExtension();
    		$request->file('foto')->storeAs('', $filename);
    		$input['foto'] = $filename;
    		$pic = $request->file('foto');
    		$pic->move(public_path().'/uploads/', $filename);
    	}

    	$result = \App\Siswa::where('nis', $id)->first();
    	$status = $result->update($input);

    	if ($status) return redirect('siswa')->with('success', 'Data Berhasil Diubah');
    	else return redirect('siswa')->with('error', 'Data Gagal Diubah');
    }

    public function destroy(Request $request, $id){
    	$result = \App\Siswa::where('nis', $id)->first();
    	$status = $result->delete();

    	if ($status) return redirect('siswa')->with('success', 'Data Berhasil Terhapus');
    	else return redirect('siswa')->with('error', 'Data Gagal Terhapus');
    }
}
