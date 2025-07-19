<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'image','rules'];
    // Define the relationship with MatchModel
    // category to be used in MatchModel
    public function matches()
    {
        return $this->hasMany(MatchModel::class, 'category_id');
    }
}
