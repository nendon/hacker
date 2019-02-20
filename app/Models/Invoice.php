<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoice';
    protected $fillable = ['code', 'status', 'price', 'promo', 'type', 'notes', 'members_id'];

    public function details()
    {
        return $this->hasMany('App\Models\InvoiceDetail');
    }
    
    public function members()
    {
        return $this->belongsTo('App\Models\Member');
    }
}
