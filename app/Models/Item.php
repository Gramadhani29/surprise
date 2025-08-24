<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model
    protected $table = 'items';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'code',
        'name',
        'message',
        'photo',
    ];
}