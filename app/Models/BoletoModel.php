<?php

namespace App\Models;

use CodeIgniter\Model;

class BoletoModel extends Model
{
    protected $table = 'boletos';
    protected $primaryKey = 'id';
    protected $useSoftDeletes = false;
    protected $useTimestamps = true;
    protected $allowedFields = [
        'rifa_id',
        'numero_boleto',
        'cliente_id',
        'estado',
        'fecha_compra',
        'resultado',
    ];
}

