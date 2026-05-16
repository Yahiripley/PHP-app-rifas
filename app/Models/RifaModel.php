<?php

namespace App\Models;

use CodeIgniter\Model;

class RifaModel extends Model
{
    protected $table = 'rifas';
    protected $primaryKey = 'id';
    protected $useSoftDeletes = false;
    protected $useTimestamps = true;
    protected $allowedFields = [
        'nombre',
        'descripcion',
        'costo_boleto',
        'fecha_sorteo',
        'premio',
        'imagen_promocional',
    ];
}

