<?php

namespace Modules\DgiiIntegration\Infrastructure\Http;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Modules\Common\Domain\Contracts\DgiiApiClientInterface;
use Modules\Common\Domain\ValueObjects\CommercialApproval;
use Modules\Common\Domain\ValueObjects\CommercialApprovalMessage;
use Modules\Common\Domain\ValueObjects\Invoice;
use Modules\Common\Domain\ValueObjects\InvoiceMessage;
use Modules\Common\Domain\ValueObjects\Token;

class DgiiApiClient implements DgiiApiClientInterface
{
    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function fetchSeed(string $environment): string
    {
        $url = config('dgii.domains.ecf').'/'.$environment.'/autenticacion/api/autenticacion/semilla';

        return Http::get($url)
            ->throw()
            ->body();
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function fetchToken(string $environment, string $seedPath): Token
    {
        $url = config('dgii.domains.ecf').'/'.$environment.'/autenticacion/api/autenticacion/validarsemilla';

        $contents = fopen(Storage::path($seedPath), 'rb');

        $response = Http::attach('xml', $contents)
            ->post($url)
            ->throw()
            ->json();

        return new Token(
            $response['token'],
            $response['expira'],
            $response['expedido'],
            $response,
        );
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function sendInvoice(string $environment, string $signedXmlPath, Token $dgiiToken): Invoice
    {
        $url = config('dgii.domains.ecf').'/'.$environment.'/recepcion/api/facturaselectronicas';

        $contents = fopen(Storage::path($signedXmlPath), 'rb');

        $response = Http::withToken($dgiiToken->token)
            ->attach('xml', $contents)
            ->post($url)
            ->throw()
            ->json();

        return new Invoice(
            $response['trackId'],
            $response['codigo'],
            $response['estado'] ?? null,
            $response['rnc'] ?? null,
            $response['encf'] ?? null,
            $response['secuenciaUtilizada'] ?? null,
            $response['fechaRecepcion'] ?? null,
            isset($response['mensajes']) ?
                collect($response['mensajes'])->map(static fn ($msg) => new InvoiceMessage($msg['codigo'], $msg['valor']))
                : [],
        );
    }

    //    /**
    //     * @throws RequestException
    //     * @throws ConnectionException
    //     */
    //    public function searchByTrackid(string $env, string $token, string $trackId): array
    //    {
    //        $url = config('dgii.domains.ecf') . '/' . $env . '/consultaresultado/api/consultas/estado';
    //
    //        return Http::withToken($token)
    //            ->get($url, ['trackid' => $trackId])
    //            ->throw()
    //            ->json();
    //    }
    //
    //    /**
    //     * @throws RequestException
    //     * @throws ConnectionException
    //     */
    //    public function getList(string $env, string $token, string $issuerIdentification, string $sequenceNumber): array
    //    {
    //        $url = config('dgii.domains.ecf') . '/' . $env . '/consultatrackids/api/trackids/consulta';
    //
    //        return Http::withToken($token)
    //            ->get($url, [
    //                'RncEmisor' => $issuerIdentification,
    //                'Encf' => $sequenceNumber,
    //            ])
    //            ->throw()
    //            ->json();
    //    }
    //
    //    public function getQRLink(string $env, string $issuerIdentification, string $sequenceNumber, string $total, string $securityCode, string $date, string $signatureDate, ?string $buyerIdentification = null): string
    //    {
    //        $parameters = [
    //            'RncEmisor' => $issuerIdentification,
    //            'ENCF' => $sequenceNumber,
    //            'MontoTotal' => $total,
    //            'CodigoSeguridad' => $securityCode,
    //            'FechaEmision' => date('d-m-Y', strtotime($date)),
    //            'FechaFirma' => date('d-m-Y H:i:s', strtotime($signatureDate)),
    //        ];
    //
    //        $base_url = sprintf('%s/%s', config('dgii.domains.ecf'), $env);
    //
    //        if ($buyerIdentification) {
    //            $parameters['RncComprador'] = $buyerIdentification;
    //        }
    //
    //        return sprintf(
    //            '%s/%s?%s',
    //            $base_url,
    //            'ConsultaTimbre',
    //            http_build_query($parameters)
    //        );
    //    }
    //
    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function sendCommercialApproval(string $environment, string $signedXmlPath, Token $dgiiToken): CommercialApproval
    {
        $url = config('dgii.domains.ecf').'/'.$environment.'/aprobacioncomercial/api/aprobacioncomercial';

        $contents = fopen(Storage::path($signedXmlPath), 'rb');

        $response = Http::withToken($dgiiToken->token)
            ->attach('xml', $contents)
            ->post($url)
            ->throw()
            ->json();

        return new CommercialApproval(
            $response['estado'],
            $response['codigo'],
            isset($response['mensajes']) ?
                collect($response['mensajes'])->map(static fn ($msg) => new CommercialApprovalMessage($msg['codigo'], $msg['valor']))
                : [],
        );
    }

    //
    //    /**
    //     * @throws ConnectionException
    //     */
    //    public function send(string $env, string $token, string $xmlPath): array
    //    {
    //        $url = config('dgii.domains.fc') . '/' . $env . '/recepcionfc/api/recepcion/ecf';
    //
    //        $contents = fopen(Storage::path($xmlPath), 'rb');
    //
    //        return Http::withToken($token)
    //            ->attach('xml', $contents)
    //            ->post($url)
    //            // ->throw()
    //            ->json();
    //    }
    //
    //    public function getQRLink(string $env, string $issuerIdentification, string $sequenceNumber, string $total, string $securityCode): string
    //    {
    //        $parameters = [
    //            'RncEmisor' => $issuerIdentification,
    //            'ENCF' => $sequenceNumber,
    //            'MontoTotal' => $total,
    //            'CodigoSeguridad' => $securityCode,
    //        ];
    //
    //        $base_url = sprintf('%s/%s', config('dgii.domains.fc'), $env);
    //
    //        return sprintf(
    //            '%s/%s?%s',
    //            $base_url,
    //            'ConsultaTimbreFC',
    //            http_build_query($parameters)
    //        );
    //    }
}
