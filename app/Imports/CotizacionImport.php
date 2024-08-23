<?php

namespace App\Imports;

use App\Models\Excel_cotizacion;
use Maatwebsite\Excel\Concerns\ToModel;

class CotizacionImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    private $skipRow = true;

    public function model(array $row)
    {
        if ($this->skipRow) {
            $this->skipRow = false;
            return null;
        }

        return new Excel_cotizacion([
            'concepto' => $row[0],
            'coti_unidad' => $row[1],
            'coti_cant_unidades' => $row[2],
            'coti_precio_unitario_mn' => $row[3],
            'coti_importe_mn' => $row[4],
            'coti_precio_unitario_dls' => $row[5],
            'coti_importe_dls' => $row[6],
        ]);
    }
}
