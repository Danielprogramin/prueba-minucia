<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Block extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'project_id'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function pieces()
    {
        return $this->hasMany(Piece::class);
    }

    public function pieceRecords()
    {
        return $this->hasMany(PieceRecord::class);
    }
}
