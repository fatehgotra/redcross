<?php

namespace App\Imports;

use App\Models\CampaignAttendance;
use App\Models\CampaignUser;
use App\Models\CommunityAttendees;
use App\Models\CommunityAttendence;
use App\Models\Receipts;
use App\Models\User;
use App\Models\UserHours;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class AddReceipt implements ToModel, WithStartRow
{
    /**
     * @return \Illuminate\Support\array
     */
    function __construct()
    {
    }

    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        //dd($row[1]);
        //$uid = User::where('email',$row[0])->get()->first();

        return new Receipts([
            'email'      => $row[0],
            'receipt_no' => $row[1],
            'image'      => $row[2],
        ]);

        // if (strtoupper($row[4]) == 'C') {

        //     $check = CommunityAttendees::where(['attendee_id' => $uid, 'community_id' => $row[5]])->get()->first();
        //     if (is_null($check)) {

        //         CommunityAttendees::create([
        //             'community_id' => $row[5],
        //             'attendee_id'  => $uid->id,
        //         ]);
        //     }
        //     return new CommunityAttendence([
        //         'email'       => $row[0],
        //         'date'        => $row[1],
        //         'activity_id' => $row[5],
        //         'starts_at'   =>Carbon::instance(Date::excelToDateTimeObject($row[2]))->format('h:i:s A'),
        //         'ends_at'     => Carbon::instance(Date::excelToDateTimeObject($row[3]))->format('h:i:s A'),
        //         'added_by'    => Auth::guard('admin')->id()
        //     ]);

        // } else {

        //     $check = CampaignUser::where(['user_id' => $uid, 'campaign_id' => $row[5]])->get()->first();
        //     if (is_null($check)) {

        //         CampaignUser::create([
        //             'campaign_id' => $row[5],
        //             'user_id'  => $uid->id,
        //         ]);
        //     }

        //     return new CampaignAttendance([
        //         'user_id'      => $uid->id,
        //         'date'         => $row[1],
        //         'starts_at'   =>Carbon::instance(Date::excelToDateTimeObject($row[2]))->format('h:i:s A'),
        //         'ends_at'     => Carbon::instance(Date::excelToDateTimeObject($row[3]))->format('h:i:s A'),
        //         'campaign_id'     => $row[5]
        //     ]);
        // }

    }
}
