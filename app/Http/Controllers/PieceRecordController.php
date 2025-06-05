<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Piece;
use App\Models\PieceRecord;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class PieceRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::with('blocks.pieces')->get();

        return Inertia::render('Formulario', [
            'projects' => $projects,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_id' => 'required|exists:projects,id',
            'block_id'   => 'required|exists:blocks,id',
            'piece_id'   => 'required|exists:pieces,id',
            'peso_real'  => 'required|numeric|min:0.01',
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        $piece = Piece::findOrFail($request->piece_id);
    
        $diferencia = abs($piece->peso_teorico - $request->peso_real);
    
        // Guarda el registro
        PieceRecord::create([
            'project_id'   => $request->project_id,
            'block_id'     => $request->block_id,
            'piece_id'     => $piece->id,
            'peso_real'    => $request->peso_real,
            'diferencia'   => $diferencia,
            'registrado_en' => now(),
        ]);
    
        // Opcional: marcar la pieza como "Fabricada"
        $piece->update(['estado' => 'Fabricada']);
    
        return redirect()->route('reporte')->with('success', 'Pieza registrada correctamente.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
