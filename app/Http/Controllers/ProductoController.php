<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use App\Http\Resources\ProductoCollection;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new ProductoCollection(Producto::where('disponible', 1)->orderBy('id', 'DESC')->get());
        // return new ProductoCollection(Producto::where('disponible', 1)->orderBy('id', 'DESC')->paginate(10));
        // return new ProductoCollection(Producto::where('disponible', 1)->orderBy('id', 'DESC')->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        // return 'producto';
        // return $producto;
        $producto->disponible = 0;
        $producto->save();
        $id = $producto->id;
        $name = $producto->nombre;
        return [
            'producto' => $producto,
            'message' => "$name marcado cómo agotado." 
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //
    }
}
