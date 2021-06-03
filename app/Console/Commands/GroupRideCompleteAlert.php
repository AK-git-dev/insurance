<?php

namespace App\Console\Commands;

use App\Models\GroupPastExperience;
use App\Models\Ride;
use App\Notifications\rideCompleteNotification;
use App\User;
use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;

class GroupRideCompleteAlert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ride:survey';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Group Rides Complete survey notification to group members';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $rides = Ride::where('group_id', '!=', 0)->where('end_date', '<', Carbon::now())->get();        
        foreach($rides as $ride) {
            $rideJoinedRiderList = $ride->joinedRiders->pluck('rider_id')->toArray();
            $ridersSurveyCompleted = $ride->pastExperience->pluck('rider_id')->toArray();
            $availableRiders = array_diff($rideJoinedRiderList, $ridersSurveyCompleted);
            if(count($availableRiders) != 0) {
                foreach($availableRiders as $rider_id) {
                                 
                    $user = User::find($rider_id);
                    $posts = [
                        'start_location' => $ride->start_location,
                        'end_location' => $ride->end_location,
                        'rider_name' => $user->name,
                        'slug' => $ride->slug,
                    ];
                    $posts = (object)$posts;
                    Notification::route('mail' , $user->email) //Sending mail to Ride Members
                                ->notify(new rideCompleteNotification($posts)); 
                    
                }
            }
        }
    }
}
