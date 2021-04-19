<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pacientesVacinas extends Model
{
    protected $table = "pacientes";
    protected $fillable = ['name', 'cpf', 'datadeNascimento','Email'];
    use HasFactory;
}
