<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vehicle\VehicleMake;
use App\Models\Vehicle\VehicleType;
use App\Services\ZohoCRMService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;

class VehicleController extends Controller
{
    public function __construct(protected ZohoCRMService $crm) {}

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function list()
    {
        //        $fields = ['id', 'Name'];
        //        $response = $this->crm->getRecords('Marcas', $fields);
        //
        //        $brands = collect($response['data'])
        //            ->map(fn ($brand) => [
        //                'IdMarca' => (int) $brand['id'],
        //                'Marca' => $brand['Name'],
        //            ])
        //            ->sortBy(fn ($brand) => reset($brand))
        //            ->values()
        //            ->toArray();

        $brands = VehicleMake::select('id', 'name')
            ->get()
            ->map(fn ($brand) => [
                'IdMarca' => (int) $brand->id,
                'Marca' => $brand->name,
            ])
            ->sortBy(fn ($brand) => reset($brand))
            ->values()
            ->toArray();

        return response()->json($brands);
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function getModel(?string $brandId = null)
    {
        //        $criteria = "Marca:equals:$brandId";
        //        $response = $this->crm->searchRecords('Modelos', $criteria);
        //
        //        $models = collect($response['data'])
        //            ->map(fn ($model) => [
        //                'IdMarca' => (int) $model['Marca']['id'],
        //                'IdModelo' => (int) $model['id'],
        //                'Modelo' => $model['Name'],
        //            ])
        //            ->sortBy(fn ($model) => reset($model))
        //            ->values()
        //            ->toArray();
        //
        //        return response()->json($models);

        $models = \App\Models\Vehicle\VehicleModel::with('make')
            ->where('vehicle_make_id', $brandId)
            ->select('id', 'name', 'vehicle_make_id')
            ->get()
            ->map(fn ($model) => [
                'IdMarca' => (int) $model->vehicle_make_id,
                'IdModelo' => (int) $model->id,
                'Modelo' => $model->name,
            ])
            ->sortBy(fn ($model) => reset($model))
            ->values()
            ->toArray();

        return response()->json($models);

    }

    public function typeList()
    {
        $types = VehicleType::select('id', 'name')
            ->get()
            ->map(fn ($type) => [
                'IdTipoVehiculo' => (int) $type->id,
                'TipoVehiculo' => $type->name,
            ])
            ->values()
            ->toArray();

        return response()->json($types);
    }

    public function accessoriesList()
    {
        $accessories = [
            [
                'IdAccesorio' => 2,
                'Accesorio' => 'Cambio de Guia',
            ],
            [
                'IdAccesorio' => 3,
                'Accesorio' => 'LOVATO',
            ],
            [
                'IdAccesorio' => 1,
                'Accesorio' => 'OTROS EQUIPO DE GAS',
            ],
            [
                'IdAccesorio' => 5,
                'Accesorio' => 'ROMANO',
            ],
            [
                'IdAccesorio' => 6,
                'Accesorio' => 'SISTEMA DE GAS NATURAL APROBADO',
            ],
        ];

        return response()->json($accessories);
    }

    public function activitiesList()
    {
        $activities = [
            [
                'IdActividad' => 1,
                'Actividad' => 'Uber',
            ],
            [
                'IdActividad' => 2,
                'Actividad' => 'Taxi',
            ],
        ];

        return response()->json($activities);
    }

    public function routeList()
    {
        $routes = [
            [
                'IdCirculacion' => 1,
                'circulacion' => 'AZUA',
            ],
            [
                'IdCirculacion' => 2,
                'circulacion' => 'BAHORUCO',
            ],
            [
                'IdCirculacion' => 3,
                'circulacion' => 'BARAHONA',
            ],
            [
                'IdCirculacion' => 4,
                'circulacion' => 'DAJABON',
            ],
            [
                'IdCirculacion' => 5,
                'circulacion' => 'DISTRITO NACIONAL',
            ],
            [
                'IdCirculacion' => 0,
                'circulacion' => 'DISTRITO NACIONAL',
            ],
        ];

        return response()->json($routes);
    }

    public function colorList()
    {
        $colors = [
            [
                'IdColor' => 2,
                'Color' => 'Amarillo',
            ],
            [
                'IdColor' => 3,
                'Color' => 'Azul',
            ],
            [
                'IdColor' => 4,
                'Color' => 'Azul Agua',
            ],
            [
                'IdColor' => 5,
                'Color' => 'Azul Cielo',
            ],
        ];

        return response()->json($colors);
    }
}
