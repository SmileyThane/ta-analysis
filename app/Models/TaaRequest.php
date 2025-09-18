<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaaRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'description',
        'attachments',
        'stripe_payment_intent_id',
        'status',
        'result_file_path',
        'email_sent'
    ];

    protected $casts = [
        'attachments' => 'array',
        'email_sent' => 'boolean'
    ];
}
