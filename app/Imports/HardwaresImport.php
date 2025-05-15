<?php

namespace App\Imports;

use App\Models\Hardware;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class HardwaresImport implements ToModel, WithHeadingRow
{

    protected $spId;

    public function __construct($spId)
    {
        $this->spId = $spId;
    }


    public function model(array $row)
    {

        \Log::info('Row data:', ['row' => $row, 'service_provider_id' => $this->spId]);

        return new Hardware([
            'hrdws_sp_id' => $this->spId,
            'hrdws_serial_number' => $row['serial_number'],
            'hrdws_hw_identifier' => $row['hw_identifier'],
            'hrdws_model_number' => $row['model_number'],
            'hrdws_model_description' => $row['model_description'],
            'hrdws_qty' => $row['qty'],
            'hrdws_family' => $row['family'],
            'hrdws_city' => $row['city'],
            'hrdws_state' => $row['state'],
            'hrdws_price' => $row['pricers'],
        ]);
    }
}
