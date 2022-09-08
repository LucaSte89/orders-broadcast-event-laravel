<?php

namespace App\Models;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Database\Eloquent\BroadcastsEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordini extends Model
{
    use BroadcastsEvents, HasFactory;

    protected $table = "ordini";

    protected $fillable = [
        'numero',
        'stato',
        'created_at',
    ];
}
