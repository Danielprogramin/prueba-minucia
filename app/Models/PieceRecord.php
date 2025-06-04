<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PieceRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'block_id',
        'piece_id',
        'peso_real',
        'diferencia',
        'registrado_en'
    ];

    protected $dates = ['registrado_en'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function block()
    {
        return $this->belongsTo(Block::class);
    }

    public function piece()
    {
        return $this->belongsTo(Piece::class);
    }
}
