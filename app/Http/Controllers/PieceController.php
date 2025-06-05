<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Piece;
use App\Models\Block;
use Inertia\Inertia;

class PieceController extends Controller
{
    public function index()
    {
        return Inertia::render('Pieces/Index', [
            'pieces' => Piece::with('block')->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('Pieces/Create', [
            'blocks' => Block::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'block_id' => 'required|exists:blocks,id',
            'peso_teorico' => 'required|numeric|min:0',
            'estado' => 'required|in:Pendiente,Fabricada',
        ]);

        Piece::create($request->only('name', 'block_id', 'peso_teorico', 'estado'));

        return redirect()->route('pieces.index')->with('success', 'Pieza creada');
    }

    public function edit(Piece $piece)
    {
        return Inertia::render('Pieces/Edit', [
            'piece' => $piece,
            'blocks' => Block::all()
        ]);
    }

    public function update(Request $request, Piece $piece)
    {
        $request->validate([
            'name' => 'required|string',
            'block_id' => 'required|exists:blocks,id',
            'peso_teorico' => 'required|numeric|min:0',
            'estado' => 'required|in:Pendiente,Fabricada',
        ]);

        $piece->update($request->only('name', 'block_id', 'peso_teorico', 'estado'));

        return redirect()->route('pieces.index')->with('success', 'Pieza actualizada');
    }

    public function destroy(Piece $piece)
    {
        $piece->delete();
        return redirect()->route('pieces.index')->with('success', 'Pieza eliminada');
    }
}
