<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    public $primaryKey = 'nis';

    protected $table = 't_siswa';

    protected $fillable = [
    	'nis', 'nama_lengkap', 'jenis_kelamin', 'alamat', 'no_telp', 'id_kelas', 'foto'
    ];

    public function getJenisKelaminDisplayAttribute(){
    	if(@$this->attributes['jenis_kelamin'] == 'L') return 'Laki-laki';
    	if(@$this->attributes['jenis_kelamin'] == 'P') return 'Perempuan';
    	return '-';
    }

    public function kelas(){
    	return $this->hasOne('\App\Kelas', 'id_kelas', 'id_kelas');
    }
}
