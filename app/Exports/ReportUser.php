<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportUser implements FromArray, WithHeadings
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

                'Name' => $u->firstname." ".$u->lastname,
                'Email'=> $u->email,
                'Phone'=> $u->phone,
                'Branch'=>$u->branch
            ];
        }
        
        return $collect;

    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Phone',
            'Branch'
        ];
    }
}
