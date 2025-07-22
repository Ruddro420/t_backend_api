<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    protected $fillable = [
    'app_name',
    'app_logo',
    'banner_1',
    'banner_2',
    'banner_3',
    'banner_4',
    'notice',
];
}
