<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ServicesImport implements ToArray, WithHeadingRow
{
    public function array(array $array)
    {
        return $array;
    }
}
