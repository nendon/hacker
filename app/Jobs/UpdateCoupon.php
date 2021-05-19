<?php

namespace App\Jobs;

use App\Models\Coupon;
use Session;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateCoupon implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $coupon;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Coupon $coupon)
    {
        $this->coupon = $coupon;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        session()->put('coupon', [
                'name' => $this->coupon->code,
                'value' => $this->coupon->value,
                'discount' => $this->coupon->discount(session()->get('total')),
                'type' => $this->coupon->type,
                'percent_off' => $this->coupon->percent_off,
            ]);
    }
}
