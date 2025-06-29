<?php

namespace App\Helpers;

class CotizarDesempleo2 extends Cotizar
{
    private $vida = 0;

    private $desempleo = 0;

    private function calcular_tasas($coberturaid)
    {
        // encontrar la tasa
        $criterio = "Plan:equals:$coberturaid";
        $tasas = $this->zoho->searchRecordsByCriteria('Tasas', $criterio);

        foreach ((array) $tasas as $tasa) {
            if (
                ! empty($tasa->getFieldValue('Tipo')) &&
                $this->cotizacion->tipo_equipo != $tasa->getFieldValue('Tipo')
            ) {
                continue;
            }

            if (
                ! empty($tasa->getFieldValue('Riesgo')) &&
                $this->cotizacion->tipo_pago != $tasa->getFieldValue('Riesgo')
            ) {
                continue;
            }

            if ($coberturaid == 3222373000222056967 and $this->cotizacion->tipo_pago == 'Mensual') {// MAPFRE
                if (
                    $this->cotizacion->suma >= $tasa->getFieldValue('Suma_limite')
                    and
                    $this->cotizacion->suma <= $tasa->getFieldValue('Suma_hasta')
                ) {

                    $this->vida = $tasa->getFieldValue('Name');
                }
            }

            $this->desempleo = $tasa->getFieldValue('Name');
        }
    }

    private function calcular_prima($coberturaid)
    {
        $this->calcular_tasas($coberturaid);

        $prima_desempleo = 0;

        if ($coberturaid == 3222373000203458058) {// SEGUROS SURA
            $prima_desempleo = ($this->cotizacion->cuota) * ($this->desempleo / 1000);
        }

        if ($coberturaid == 3222373000203458044) {// HUMANO SEGUROS
            $prima_desempleo = ($this->cotizacion->suma) * ($this->desempleo / 100);
        }

        if ($coberturaid == 3222373000222056967) {// MAPFRE
            $prima_desempleo = $this->cotizacion->cuota * ($this->desempleo / 100);
        }

        if (! empty($this->vida)) {
            $prima_desempleo = $this->vida;
        }

        return $prima_desempleo;
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
