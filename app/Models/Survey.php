<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;
    protected $table = 'survey';

    protected $fillable = [
        'user_id',
        'kecamatan_id',
        'pecahan_id',
        'qlt',
        'foto',
        'tgl_survey'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function kecamatan(){
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id', 'id');
    }

    public function pecahan(){
        return $this->belongsTo(Kecamatan::class, 'pecahan_id', 'id');
    }
}
