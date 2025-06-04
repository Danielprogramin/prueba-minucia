<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Piece extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'block_id', 'peso_teorico', 'estado'];

    public function block()
    {
        return $this->belongsTo(Block::class);
    }

    public function pieceRecords()
    {
        return $this->hasMany(PieceRecord::class);
    }
}
