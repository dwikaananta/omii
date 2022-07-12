<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sandal extends Model
{
    use HasFactory;

    protected $table = 'sandal';

    protected $fillable = [
        'jumlah',
        'bulan',
    ];
}
