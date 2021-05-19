<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotifEmail extends Model
{
    protected $table = "notif_email";
    protected $fillable = ['title', 'member_id', 'id_notif', 'type'];
}
