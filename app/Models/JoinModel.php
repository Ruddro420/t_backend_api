<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JoinModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'match_id',
        'game_type',
        'entry_fee',
        'game_date',
        'game_time',
        'win_prize',
        'status',
        'pname1',
        'pname2',
        'game_name',
        'pay',
        'ex1',
        'ex2'
    ];
    public function join()
    {
        return $this->hasMany(JoinModel::class, 'match_id');
    }
}
