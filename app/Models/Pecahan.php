<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pecahan extends Model
{
    use HasFactory;
    protected $table = 'pecahan';

    protected $fillable = [
        'pecahan'
    ];

    public function survey(){
        return $this->hasMany(Survey::class );
    }
}
