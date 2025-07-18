<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchModel extends Model
{
    use HasFactory;
    protected $fillable = [
    'match_name', 'category', 'max_player', 'map_name', 'version',
    'game_type', 'game_mood', 'time', 'date',
    'win_price', 'kill_price', 'entry_fee',
    'second_prize', 'third_prize', 'fourth_prize', 'fifth_prize', 'total_prize','match_id'
];
}
