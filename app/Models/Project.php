<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function blocks()
    {
        return $this->hasMany(Block::class);
    }

    public function pieceRecords()
    {
        return $this->hasMany(PieceRecord::class);
    }
}
