<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $collection = 'tb_mhsw';

    protected $fillable = ['mhsw_nim', 'mhsw_nama', 'mhsw_alamat', 'mhsw_prodi'];
}
