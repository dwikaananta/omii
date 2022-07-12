<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Heels extends Model
{
    use HasFactory;

    protected $table = 'heels';

    protected $fillable = [
        'jumlah',
        'bulan',
    ];
}
