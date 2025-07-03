<?php

namespace App\Helpers;

class CotizarIncendio3 extends Cotizar
{
    private $deudor = 0;

    private $codeudor = 0;

    public $no_vida = false;

    private function verificar_comentarios($Suma_asegurada_min, $Suma_asegurada_max): string
    {
        if ($comentario = $this->limite_suma($Suma_asegurada_min, $Suma_asegurada_max)) {
            return $comentario;
        }

        return '';
    }

    private function calcular_tasas1($coberturaid)
    {
        $valortasa = 0;

        $criterio = "((Plan:equals:$coberturaid) and (Tipo:equals:Vida))";
        $tasas = $this->zoho->searchRecordsByCriteria('Tasas', $criterio);

        foreach ((array) $tasas as $tasa) {
            if (
                $this->calcular_edad($this->cotizacion->fecha_deudor) >= $tasa->getFieldValue('Edad_min')
                and
                $this->calcular_edad($this->cotizacion->fecha_deudor) <= $tasa->getFieldValue('Edad_max')
            ) {
                $this->deudor = $tasa->getFieldValue('Name') / 100;
            }

            if (! empty($this->cotizacion->fecha_codeudor)) {
                if (
                    $this->calcular_edad($this->cotizacion->fecha_codeudor) >= $tasa->getFieldValue('Edad_min')
                    and
                    $this->calcular_edad($this->cotizacion->fecha_codeudor) <= $tasa->getFieldValue('Edad_max')
                ) {
                    $this->codeudor = $tasa->getFieldValue('Codeudor') / 100;
                }
            }
        }

        return $valortasa;
    }

    private function calcular_tasas2($coberturaid)
    {
        $valortasa = 0;

        $criterio = "((Plan:equals:$coberturaid) and (Tipo:equals:Incendio))";
        $tasas = $this->zoho->searchRecordsByCriteria('Tasas', $criterio);

        foreach ((array) $tasas as $tasa) {
            if ($this->cotizacion->riesgo == $tasa->getFieldValue('Riesgo')) {
                $valortasa = $tasa->getFieldValue('Name') / 100;
            }
        }

        return $valortasa;
    }

    private function calcular_prima1($coberturaid)
    {
        // calcular tasas
        $this->calcular_tasas1($coberturaid);

        $monto_prima = 0;
        if (! empty($this->cotizacion->fecha_codeudor)) {
            $prima_deudor = ($this->cotizacion->prestamo / 1000) * $this->deudor;
            $prima_codeudor = ($this->cotizacion->prestamo / 1000) * ($this->codeudor - $this->deudor);
            $monto_prima = $prima_deudor + $prima_codeudor;
        } else {
            $monto_prima = ($this->cotizacion->prestamo / 1000) * $this->deudor;
        }

        return $monto_prima;
    }

    private function calcular_prima2($coberturaid)
    {
        $tasa = $this->calcular_tasas2($coberturaid);

        return ($this->cotizacion->suma / 1000) * $tasa;
    }

    public function cotizar_planes()
    {
        // planes relacionados al banco
        $criterio = '((Corredor:equals:'. 3222373000092390001 .') and (Product_Category:equals:Incendio))';
        $coberturas = $this->zoho->searchRecordsByCriteria('Products', $criterio);

        foreach ((array) $coberturas as $cobertura) {
            // inicializacion de variables
            $prima = 0;
            $primaVida = 0;
            $primaIncendio = 0;

            // verificaciones
            $comentario = $this->verificar_comentarios(
                $cobertura->getFieldValue('Suma_asegurada_min'),
                $cobertura->getFieldValue('Suma_asegurada_max')
            );

            //            if ($this->cotizacion->prestamo > $cobertura->getFieldValue('Pr_stamo_max')) {
            //                $comentario = 'El valor de prestamo supera el límite establecido.';
            //            }

            // si no hubo un excepcion
            if (empty($comentario)) {
                if (! $this->no_vida) {
                    $primaVida = $this->calcular_prima1($cobertura->getEntityId());

                    if (empty($primaVida)) {
                        $comentario = 'No existe prima para Vida.';
                    }
                }

                $primaIncendio = $this->calcular_prima2($cobertura->getEntityId());

                if (empty($primaIncendio)) {
                    $comentario = 'No existe prima para Incendio.';
                }
            }

            $prima = $primaVida + $primaIncendio;

            $this->cotizacion->planes[] = [
                'aseguradora' => $cobertura->getFieldValue('Product_Name'),
                'planid' => $cobertura->getEntityId(),
                'prima' => $prima - ($prima * 0.16),
                'neta' => $prima * 0.16,
                'total' => $prima,
                'suma' => $this->cotizacion->suma,
                'comentario' => $comentario,
                'prima_vida' => $primaVida,
            ];
        }
    }
}
