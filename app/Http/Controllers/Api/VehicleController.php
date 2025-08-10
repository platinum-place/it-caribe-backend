<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ZohoCRMService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleAccessory;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleActivity;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleColor;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleMake;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleModel;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleType;

class VehicleController extends Controller
{
    public function __construct(protected ZohoCRMService $crm) {}

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function makeList()
    {
        $brands = VehicleMake::all()->map(function ($brand) {
            return [
                'IdMarca' => $brand->id,
                'Marca' => $brand->name,
            ];
        });

        return response()->json($brands);
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function modelList(string $makeId)
    {
        $models = VehicleModel::where('vehicle_make_id', $makeId)
            ->get()
            ->map(function ($model) {
                return [
                    'IdMarca' => $model->vehicle_make_id,
                    'IdModelo' => $model->id,
                    'Modelo' => $model->name,
                ];
            })
            ->sortBy(fn ($model) => reset($model));

        return response()->json($models);

    }

    public function typeList()
    {
        $types = VehicleType::all()->map(function ($type) {
            return [
                'IdTipoVehiculo' => $type->id,
                'TipoVehiculo' => $type->name,
            ];
        });

        return response()->json($types);
    }

    public function accessoriesList()
    {
        $accessories = VehicleAccessory::all()->map(function ($accessory) {
            return [
                'IdAccesorio' => $accessory->id,
                'Accesorio' => $accessory->name,
            ];
        });

        return response()->json($accessories);
    }

    public function activitiesList()
    {
        $activities = VehicleActivity::all()->map(function ($activity) {
            return [
                'IdActividad' => $activity->id,
                'Actividad' => $activity->name,
            ];
        });

        return response()->json($activities);
    }

    public function routeList()
    {
        $routes = VehicleActivity::all()->map(function ($route) {
            return [
                'IdCirculacion' => $route->id,
                'circulacion' => $route->name,
            ];
        });

        return response()->json($routes);
    }

    public function colorList()
    {
        $colors = VehicleColor::all()->map(function ($color) {
            return [
                'IdColor' => $color->id,
                'Color' => $color->name,
            ];
        });

        return response()->json($colors);
    }
}
