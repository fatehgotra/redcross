<?php

namespace App\Imports;

use App\Models\userHours;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class AddHours implements ToModel, WithStartRow
{
    /**
    * @return \Illuminate\Support\array
    */
    function __construct() {
       
    }

    public function startRow(): int
    {
        return 2;
    }

    public function model( array $row)
    {
     
        return new userHours([
            'email'      => $row[0],
            'date'       => $row[1],
            'start_time' =>Carbon::instance(Date::excelToDateTimeObject($row[2]))->format('h:i:s A'),
            'end_time'   =>Carbon::instance(Date::excelToDateTimeObject($row[3]))->format('h:i:s A'),
            'added_by'   =>Auth::guard('admin')->id()
        ]);

    }
}
