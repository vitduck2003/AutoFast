<?php

namespace App\Console\Commands;

use App\Models\BookingDetail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use DB;
use App\Jobs\ScheduleOrderEmail;
use App\Jobs\SendOrderSuccessEmail;

class OrderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'review order success';

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
     * @return mixed
     */
    public function handle()
    {
        $users = BookingDetail::whereMonth('created_at', '=', Carbon::now()->month)
            ->whereDay('created_at', '=', now()->day)
            ->get();
        $users->load('booking');
        foreach ($users as $item) {
            $email = $item->booking->email;
            $name = $item->booking->name;
            $details = [
                'email' => $email,
                'name' => $name,
            ];
            dispatch(new ScheduleOrderEmail($details));
        }
    }
}
