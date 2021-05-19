<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Member;
use App\Models\Lesson;
use App\Mail\EmailReminderKetiga;
use DB;
use Mail;

class ReminderKetiga extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:reminderketiga';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command keempat';

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
        $invo = Invoice::with('members')
        ->where('invoice.status', 2)
        ->where(DB::raw('left(DATE_ADD( invoice.created_at, INTERVAL 23 HOUR), 16)'), '=', DB::raw(' left(now(), 16)') )
        ->get();
            foreach($invo as $inv){
                if($inv != null){
                    Mail::to($inv->members['email'])->send(new EmailReminderKetiga());
                } 
            }
            $this->info('Reminder messages sent successfully!');
    }
}
