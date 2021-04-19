<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class registrovacinacao extends Model
{
    protected $table = "vacinaregistro";
    protected $fillable = ['id_vacina', 'dataVacinacao', 'cpfId','idDose'];
    use HasFactory;
}
