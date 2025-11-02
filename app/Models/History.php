<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'history'; // atau 'history' kalau tabel kamu singular
    protected $primaryKey = 'id_history';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_history', 'tanggal', 'grade', 'bobot', 'ukuran', 'foto'
    ];
}
