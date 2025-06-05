<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Block;
use App\Models\Project;
use Inertia\Inertia;

class BlockController extends Controller
{
    public function index()
    {
        return Inertia::render('Blocks/Index', [
            'blocks' => Block::with('project')->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('Blocks/Create', [
            'projects' => Project::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'project_id' => 'required|exists:projects,id',
        ]);

        Block::create($request->only('name', 'project_id'));

        return redirect()->route('blocks.index')->with('success', 'Bloque creado');
    }

    public function edit(Block $block)
    {
        return Inertia::render('Blocks/Edit', [
            'block' => $block,
            'projects' => Project::all()
        ]);
    }

    public function update(Request $request, Block $block)
    {
        $request->validate([
            'name' => 'required|string',
            'project_id' => 'required|exists:projects,id',
        ]);

        $block->update($request->only('name', 'project_id'));

        return redirect()->route('blocks.index')->with('success', 'Bloque actualizado');
    }

    public function destroy(Block $block)
    {
        $block->delete();
        return redirect()->route('blocks.index')->with('success', 'Bloque eliminado');
    }
}
