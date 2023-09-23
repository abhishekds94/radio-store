<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IPLog extends Model
{
    use HasFactory;

    protected $table = 'ip_logs';

    protected $fillable = ['device_name', 'active', 'ip_address', 'address'];

}
