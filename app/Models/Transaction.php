<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'invoice_id',
        'user_id', 
        'invoice_status',
        'invoice_url',
        'invoice_reference' ,
        'created_date' ,
        'expiry_date' ,
        'expiry_time' ,
        'invoice_value' ,
        'invoice_display_value' ,
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
