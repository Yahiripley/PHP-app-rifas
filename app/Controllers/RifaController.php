<?php

namespace App\Controllers;

use App\Models\BoletoModel;
use App\Models\RifaModel;

class RifaController extends BaseController
{
    private const TOTAL_BOLETOS = 11;
    private const TOTAL_GANADORES = 3;

    public function index()
    {
        $auth = seguridad(['admin', 'trabajador']);
        if ($auth) {
            return $auth;
        }

        $rifas = (new RifaModel())->orderBy('id', 'DESC')->findAll();
        return view('rifas/index', ['rifas' => $rifas]);
    }

    public function catalogo()
    {
        $auth = seguridad(['cliente']);
        if ($auth) {
            return $auth;
        }

        $rifas = (new RifaModel())->orderBy('id', 'DESC')->findAll();
        return view('rifas/catalogo', ['rifas' => $rifas]);
    }

    public function show($id)
    {
        $auth = seguridad();
        if ($auth) {
            return $auth;
        }

        $rifaModel = new RifaModel();
        $boletoModel = new BoletoModel();

        $rifa = $rifaModel->find($id);
        if (!$rifa) {
            return redirect()->back()->with('error', 'Rifa no encontrada.');
        }

        $boletos = $boletoModel->where('rifa_id', $id)->orderBy('numero_boleto', 'ASC')->findAll();
        $view = session()->get('usuario.rol') === 'cliente' ? 'rifas/public_show' : 'rifas/show';

        return view($view, [
            'rifa' => $rifa,
            'boletos' => $boletos,
        ]);
    }

    public function create()
    {
        $auth = seguridad(['admin', 'trabajador']);
        if ($auth) {
            return $auth;
        }

        return view('rifas/form', ['rifa' => null, 'action' => '/rifas/store']);
    }

    public function store()
    {
        $auth = seguridad(['admin', 'trabajador']);
        if ($auth) {
            return $auth;
        }

        $reglas = $this->rifaValidationRules();

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $rifaData = [
            'nombre' => $this->request->getPost('nombre'),
            'descripcion' => $this->request->getPost('descripcion'),
            'costo_boleto' => $this->request->getPost('costo_boleto'),
            'fecha_sorteo' => $this->request->getPost('fecha_sorteo'),
            'premio' => $this->request->getPost('premio'),
            'imagen_promocional' => $this->request->getPost('imagen_promocional'),
        ];

        $rifaModel = new RifaModel();
        $boletoModel = new BoletoModel();

        $rifaId = $rifaModel->insert($rifaData);

        $boletos = [];
        for ($i = 0; $i < self::TOTAL_BOLETOS; $i++) {
            $boletos[] = [
                'rifa_id' => $rifaId,
                'numero_boleto' => str_pad((string) $i, 2, '0', STR_PAD_LEFT),
                'estado' => 'disponible',
                'resultado' => 'ninguno',
            ];
        }
        $boletoModel->insertBatch($boletos);

        return redirect()->to('/rifas/' . $rifaId)->with('msg', 'Rifa creada y boletos generados.');
    }

    public function edit($id)
    {
        $auth = seguridad(['admin', 'trabajador']);
        if ($auth) {
            return $auth;
        }

        $rifa = (new RifaModel())->find($id);
        if (!$rifa) {
            return redirect()->to('/rifas')->with('error', 'Rifa no encontrada.');
        }

        return view('rifas/form', ['rifa' => $rifa, 'action' => '/rifas/update/' . $id]);
    }

    public function update($id)
    {
        $auth = seguridad(['admin', 'trabajador']);
        if ($auth) {
            return $auth;
        }

        $rifaModel = new RifaModel();
        $rifa = $rifaModel->find($id);
        if (!$rifa) {
            return redirect()->to('/rifas')->with('error', 'Rifa no encontrada.');
        }

        $reglas = $this->rifaValidationRules();

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $rifaModel->update($id, [
            'nombre' => $this->request->getPost('nombre'),
            'descripcion' => $this->request->getPost('descripcion'),
            'costo_boleto' => $this->request->getPost('costo_boleto'),
            'fecha_sorteo' => $this->request->getPost('fecha_sorteo'),
            'premio' => $this->request->getPost('premio'),
            'imagen_promocional' => $this->request->getPost('imagen_promocional'),
        ]);

        return redirect()->to('/rifas/' . $id)->with('msg', 'Rifa actualizada.');
    }

    public function delete($id)
    {
        $auth = seguridad(['admin']);
        if ($auth) {
            return $auth;
        }
        if (!$this->request->is('post')) {
            return redirect()->to('/rifas')->with('error', 'Método no permitido.');
        }
        
        $rifaModel = new RifaModel();
        if (!$rifaModel->find($id)) {
            return redirect()->to('/rifas')->with('error', 'Rifa no encontrada.');
        }

        $rifaModel->delete($id);
        return redirect()->to('/rifas')->with('msg', 'Rifa eliminada.');
    }

    public function comprar($rifaId, $boletoId)
    {
        $auth = seguridad(['cliente']);
        if ($auth) {
            return $auth;
        }

        $boletoModel = new BoletoModel();
        $boleto = $boletoModel->where('id', $boletoId)->where('rifa_id', $rifaId)->first();

        if (!$boleto) {
            return redirect()->back()->with('error', 'Boleto no encontrado.');
        }

        if ($boleto['estado'] !== 'disponible') {
            return redirect()->back()->with('error', 'El boleto ya no está disponible.');
        }

        $boletoModel->update($boletoId, [
            'cliente_id' => session()->get('usuario.id'),
            'estado' => 'pagado',
            'fecha_compra' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/rifas/' . $rifaId)->with('msg', 'Boleto comprado correctamente.');
    }

    public function simular($id)
    {
        $auth = seguridad(['admin', 'trabajador']);
        if ($auth) {
            return $auth;
        }

        $boletoModel = new BoletoModel();
        $participantes = $boletoModel
            ->where('rifa_id', $id)
            ->where('estado', 'pagado')
            ->findAll();

        if (count($participantes) < self::TOTAL_GANADORES) {
            return redirect()->to('/rifas/' . $id)->with('error', 'Se requieren al menos 3 boletos pagados.');
        }

        shuffle($participantes);
        $ganadores = array_slice($participantes, 0, self::TOTAL_GANADORES);

        $db = \Config\Database::connect();
        $db->transStart();

        $boletoModel->where('rifa_id', $id)->set(['resultado' => 'ninguno'])->update();
        $boletoModel->update($ganadores[0]['id'], ['resultado' => 'primero']);
        $boletoModel->update($ganadores[1]['id'], ['resultado' => 'segundo']);
        $boletoModel->update($ganadores[2]['id'], ['resultado' => 'tercero']);

        $db->transComplete();

        return redirect()->to('/rifas/' . $id)->with('msg', 'Sorteo simulado exitosamente.');
    }

    private function rifaValidationRules(): array
    {
        return [
            'nombre' => 'required|min_length[3]',
            'descripcion' => 'permit_empty',
            'costo_boleto' => 'required|numeric|greater_than[0]',
            'fecha_sorteo' => 'required|valid_date',
            'premio' => 'required',
            'imagen_promocional' => 'permit_empty|valid_url|max_length[255]',
        ];
    }
}
