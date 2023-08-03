<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\RenewMembershipNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class MembershipExpiring extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:membership-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::whereIn('role', ['member', 'both'])->whereNotNull('expiry_date')->get();
        foreach($users as $user){
            $user->days = Carbon::parse($user->expiry_date)->diffInDays();
            if($user->days > 13 && $user->days <= 14){                
                $user->notify(new RenewMembershipNotification());
            }
        }
        $this->info("All members whose membership will expire in the next 14 days are notified.");
    }
}
