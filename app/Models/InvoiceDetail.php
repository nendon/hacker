<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{   
    protected $table = 'invoice_details';
    protected $fillable = ['invoice_id', 'lesson_id', 'contributor_id', 'flag', 'harga_lesson','bootcamp_id'];
    public $timestamps = true;
    public function invoice()
    {
        return $this->belongsTo('App\Models\Invoice');
    }
}
