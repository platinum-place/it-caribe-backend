<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Partners\TmpVendorProduct;
use App\Services\ZohoCRMService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;

class ProductController extends Controller
{
    public function __construct(protected ZohoCRMService $crm) {}

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function list()
    {
        $criteria = 'Corredor:equals:3222373000092390001';
        $response = $this->crm->searchRecords('Products', $criteria);

        $products = collect($response['data'])
            ->map(fn ($product) => [
                'IdProducto' => TmpVendorProduct::firstWhere('id_crm', $product['id'])->id,
                'Producto' => $product['Product_Category'],
            ])
            ->sortBy(fn ($product) => reset($product))
            ->values()
            ->toArray();

        return response()->json($products);
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function show(string $id)
    {
        $tmp = TmpVendorProduct::findOrFail($id);

        $fields = ['id', 'Vendor_Name', 'Product_Name'];
        $response = $this->crm->getRecords('Products', $fields, $tmp->id_crm);

        $response2 = $this->crm->getRecords('Vendors', ['Nombre'], (int) $response['data'][0]['Vendor_Name']['id']);

        $product = [
            'IdAseguradora' => (int) $response['data'][0]['Vendor_Name']['id'],
            'Aseguradora' => $response2['data'][0]['Nombre'],
        ];

        return response()->json($product);
    }
}
