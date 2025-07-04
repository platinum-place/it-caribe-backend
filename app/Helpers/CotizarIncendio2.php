<?php

namespace App\Helpers;

class CotizarIncendio2 extends Cotizar
{
    private function verificar_comentarios($Suma_asegurada_min, $Suma_asegurada_max): string
    {
        if ($comentario = $this->limite_suma($Suma_asegurada_min, $Suma_asegurada_max)) {
            return $comentario;
        }

        return '';
    }

    private function calcular_tasas($coberturaid)
    {
        $valortasa = 0;

        $criterio = "Plan:equals:$coberturaid";
        $tasas = $this->zoho->searchRecordsByCriteria('Tasas', $criterio);

        foreach ((array) $tasas as $tasa) {
            $valortasa = $tasa->getFieldValue('Name') / 12;
        }

        return $valortasa;
    }

    private function calcular_prima($coberturaid)
    {
        $tasa = $this->calcular_tasas($coberturaid);

        return ($this->cotizacion->suma / 1000) * $tasa;
    }

    public function cotizar_planes()
    {
        // planes relacionados al banco
        $criterio = '((Corredor:equals:'. 3222373000092390001 .') and (Product_Category:equals:Leasing))';
        $coberturas = $this->zoho->searchRecordsByCriteria('Products', $criterio);

        foreach ((array) $coberturas as $cobertura) {
            // inicializacion de variables
            $prima = 0;

            // verificaciones
            $comentario = $this->verificar_comentarios(
                $cobertura->getFieldValue('Suma_asegurada_min'),
                $cobertura->getFieldValue('Suma_asegurada_max')
            );

            if ($this->cotizacion->prestamo > $cobertura->getFieldValue('Pr_stamo_max')) {
                $comentario = 'El valor de prestamo supera el límite establecido.';
            }

            // si no hubo un excepcion
            if (empty($comentario)) {
                $prima = $this->calcular_prima($cobertura->getEntityId());
            }

            // lista con los resultados de cada calculo
            $this->cotizacion->planes[] = [
                'aseguradora' => $cobertura->getFieldValue('Product_Name'),
                'planid' => $cobertura->getEntityId(),
                'prima' => $prima - ($prima * 0.16),
                'neta' => $prima * 0.16,
                'total' => $prima,
                'suma' => $this->cotizacion->suma,
                'comentario' => $comentario,
            ];
        }
    }
}
