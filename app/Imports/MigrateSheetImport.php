<?php

namespace App\Imports;

use App\Models\QuoteVehicle;
use App\Models\QuoteVehicleLine;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Modules\Quote\Domain\Enums\QuoteLineStatusEnum;
use Modules\Quote\Domain\Enums\QuoteStatusEnum;
use Modules\Quote\Domain\Enums\QuoteTypeEnum;
use Modules\Quote\Infrastructure\Persistance\Models\Debtor;
use Modules\Quote\Infrastructure\Persistance\Models\Quote;
use Modules\Quote\Infrastructure\Persistance\Models\QuoteLine;
use Modules\Vehicle\Infrastructure\Persistence\Models\Vehicle;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleMake;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleModel;

class MigrateSheetImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $collection)
    {
        foreach ($collection as $item) {
            $fecha = Carbon::createFromFormat('Y-m-d', '1900-01-01')->addDays($item['fecha_de_nacimiento'] - 2); // restamos 2 por el bug de Excel y día base

            dd($fecha->format('d/m/Y H:i:s'));
            $debtor = Debtor::create([
                'first_name' => $item['nombe'],
                'identity_number' => $item['identificacion'],
                'birth_date' => $item['fecha_de_nacimiento'],
                //                'home_phone' => $item['home_phone'],
                //                'mobile_phone' => $item['mobile_phone'],
                //                'work_phone' => $item['work_phone'],
                //                'email' => $item['email'],
                //                'address' => $item['address'],
                'age' => Carbon::parse($item['fecha_de_nacimiento'])->age,
            ]);

            $quote = Quote::create([
                'quote_type_id' => QuoteTypeEnum::VEHICLE->value,
                'quote_status_id' => QuoteStatusEnum::APPROVED->value,
                'start_date' => $item['fecha'],
                'end_date' => $item['vencimiento'],
                'debtor_id' => $debtor->id,
                //                'user_id' => auth()->id(),
            ]);

            $make = VehicleMake::whereRaw('LOWER(name) = ?', [strtolower($item['marca'])])->firstOrFail();

            dd($make);
            $model = VehicleModel::whereRaw('LOWER(name) = ?', [strtolower($item['modelo'])])->firstOrFail();

            $vehicle = Vehicle::create([
                'vehicle_year' => $item['año'],
                'chassis' => $item['chasis'],
                'license_plate' => $item['license_plate'],
                'vehicle_make_id' => $make->id,
                'vehicle_model_id' => $model->id,
                'vehicle_type_id' => $model->vehicle_type_id,
            ]);

            $quoteVehicle = QuoteVehicle::create([
                'quote_id' => $quote->id,
                'vehicle_id' => $vehicle->id,
                'vehicle_make_id' => $make->id,
                'vehicle_year' => $item['vehicle_year'],
                'vehicle_model_id' => $model->id,
                'vehicle_type_id' => $model->vehicle_type_id,
                //                'vehicle_use_id' => $item['vehicle_use_id'],
                //                'vehicle_activity_id' => $item['vehicle_activity_id'],
                'vehicle_amount' => $item['valor_asegurado'],
                //                'vehicle_loan_type_id' => $item['vehicle_loan_type_id'],
                //                'is_employee' => $item['is_employee'],
                //                'leasing' => $item['leasing'],
                //                'loan_amount' => $item['loan_amount'],
            ]);
            $vehicle->colors()->attach($item['vehicle_colors']);
            $quoteVehicle->vehicleColors()->attach($item['vehicle_colors']);

            $quoteLine = QuoteLine::create([
                'name' => $estimate['name'],
                'unit_price' => $estimate['unit_price'],
                'quantity' => $estimate['quantity'],
                'subtotal' => $estimate['subtotal'],
                'amount_taxed' => $estimate['amount_taxed'],
                'tax_rate' => $estimate['tax_rate'],
                'tax_amount' => $estimate['tax_amount'],
                'total' => $estimate['total'],
                'quote_id' => $quote->id,
                'id_crm' => $estimate['id_crm'],
                'quote_line_status_id' => QuoteLineStatusEnum::NOT_ACCEPTED->value,
            ]);

            $quoteVehicleLine = QuoteVehicleLine::create([
                'quote_vehicle_id' => $quoteVehicle->id,
                'quote_line_id' => $quoteLine->id,
                'life_amount' => $estimate['life_amount'],
            ]);
        }
    }
}
