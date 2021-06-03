<?php

namespace App\Console\Commands;

use App\Models\RiderProfile;
use App\Models\RiderRatingSystem;
use App\User;
use Illuminate\Console\Command;

class UpdateRiderRating extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:rating';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Rider Rating';

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
        $users = User::where('is_admin', 0)->get();
        $total = 0;
        foreach($users as $user) {

            $rides = $user->rides->where('is_approved', 1)->count();
            if($rides > 0) {
                $point = $this->getRiderRating(1);
                $total += $point;
            }

            $events = $user->events->where('is_approved', 1)->count();
            if($events > 0) {
                $point = $this->getRiderRating(2);
                $total += $point;
            }

            $bikes = $user->bikes->where('is_approved', 1)->count();
            if($bikes > 0) {
                $point = $this->getRiderRating(3);
                $total += $point;
            }

            $groups = $user->groups->where('is_approved', 1)->count();
            if($groups > 0) {
                $point = $this->getRiderRating(4);
                $total += $point;
            }

            $suppliers = $user->suppliers->where('is_approved', 1)->count();
            if($suppliers > 0) {
                $point = $this->getRiderRating(5);
                $total += $point;
            }

            $tips = $user->tips->where('is_approved', 1)->count();
            if($tips > 0) {
                $point = $this->getRiderRating(6);
                $total += $point;
            }

            $polls = $user->polls->where('is_approved', 1)->count();
            if($polls > 0) {
                $point = $this->getRiderRating(7);
                $total += $point;
            }

            $features = $user->features->where('is_approved', 1)->count();
            if($features > 0) {
                $point = $this->getRiderRating(8);
                $total += $point;
            }
            
            RiderProfile::where('rider_id', $user->id)->update(['rating' => $total]);
        }
    }

    public function getRiderRating($id)
    {   
        $point = RiderRatingSystem::where('id', $id)->pluck('point')->first();
        return $point;
    }
}




