<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportHours implements FromArray, WithHeadings
{
    /**
    * @return \Illuminate\Support\array
    */

    protected $users;

    function __construct($users) {
        $this->users = $users;
    }

    public function array():array
    {
     
        $collect = [];
        foreach(  $this->users as $k => $u){
            $collect[] = [
                'Activity' => $u['Activity'],
                'Date'=> $u['date'],
                'StartTime'=> $u['start_time'],
                'EndTime'=>$u['end_time']
            ];
        }
        
        return $collect;

    }

    public function headings(): array
    {
        return [
            'Activity',
            'Date',
            'StartTime',
            'EndTime',
        ];
    }
}
