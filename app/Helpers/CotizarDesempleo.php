<?php

namespace App\Helpers;

class CotizarDesempleo extends Cotizar
{
    private $vida = 0;

    private $desempleo = 0;

    private function calcular_tasas($coberturaid)
    {
        // encontrar la tasa
        $criterio = "Plan:equals:$coberturaid";
        $tasas = $this->zoho->searchRecordsByCriteria('Tasas', $criterio);

        foreach ((array) $tasas as $tasa) {
            // verificar limite de edad
            if (
                $this->calcular_edad($this->cotizacion->fecha_deudor) >= $tasa->getFieldValue('Edad_min')
                and
                $this->calcular_edad($this->cotizacion->fecha_deudor) <= $tasa->getFieldValue('Edad_max')
            ) {
                $this->vida = $tasa->getFieldValue('Name') / 100;
                $this->desempleo = $tasa->getFieldValue('Desempleo');
            }
        }
    }

    private function calcular_prima($coberturaid)
    {
        // calcular tasas
        $this->calcular_tasas($coberturaid);

        // prima
        $prima_vida = ($this->cotizacion->suma / 1000) * $this->vida;
        $prima_desempleo = ($this->cotizacion->cuota / 1000) * $this->desempleo;

        // retornar la union de ambas primas
        return $prima_vida + $prima_desempleo;
    }

    private function verificar_comentarios($Plazo_max, $Suma_asegurada_min, $Suma_asegurada_max): string
    {
        if ($comentario = $this->limite_plazo($Plazo_max)) {
            return $comentario;
        }

        if ($comentario = $this->limite_suma($Suma_asegurada_min, $Suma_asegurada_max)) {
            return $comentario;
        }

        return '';
    }

    public function cotizar_planes()
    {
        // planes relacionados al banco
        $criterio = '((Corredor:equals:'. 3222373000092390001 .') and (Product_Category:equals:Desempleo))';
        $coberturas = $this->zoho->searchRecordsByCriteria('Products', $criterio);

        foreach ((array) $coberturas as $cobertura) {
            // inicializacion de variables
            $prima = 0;

            // verificaciones
            $comentario = $this->verificar_comentarios(
                $cobertura->getFieldValue('Plazo_max'),
                $cobertura->getFieldValue('Suma_asegurada_min'),
                $cobertura->getFieldValue('Suma_asegurada_max')
            );

            // si no hubo un excepcion
            if (empty($comentario)) {
                $prima = $this->calcular_prima($cobertura->getEntityId());

                if ($prima == 0 and ! empty($cobertura->getFieldValue('Prima_m_nima'))) {
                    $prima = $cobertura->getFieldValue('Prima_m_nima');
                }

                // en caso de haber algun problema
                if ($prima == 0) {
                    $comentario = 'La edad del deudor no esta dentro del limite permitido.';
                }
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

            $this->vida = 0;
            $this->desempleo = 0;
        }
    }
}
