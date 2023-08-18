<?php

namespace App\Exports;

use App\Models\UserHours;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportHours implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\array
     */

    protected $email;

    function __construct($email)
    {
        $this->email = $email;
    }

    public function collection()
    {


        $collect = UserHours::where('email',$this->email)
        ->select('date','start_time','end_time','comment')
        ->get();

        return $collect;
    }

    public function headings(): array
    {
        return [

            'Date',
            'StartTime',
            'EndTime',
            'Comment',
        ];
    }
}
