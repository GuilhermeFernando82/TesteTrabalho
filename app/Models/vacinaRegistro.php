<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vacinaRegistro extends Model
{
    protected $table = "vacina";
    protected $fillable = ['fabricante', 'lotes', 'datadeValidade','numerosdeDoses','intervaloDoses'];
    use HasFactory;
}
