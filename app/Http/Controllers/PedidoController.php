<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pedido;
use Illuminate\Http\Request;
use App\Models\PedidoProducto;
// use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PedidoCollection;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return 'pedidos...';
        return new PedidoCollection(Pedido::with('user')->with('productos')->where('estado', 0)->orderBy('id','DESC')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pedido = new Pedido;
        $pedido->user_id = Auth::id();
        $pedido->total = $request->total;
        $pedido->save();

        // Obtener el id del pedido insertado
        $id = $pedido->id;        

        //Obtener los productos
        $productos = $request->productos;

        //Formatear un arreglo
        foreach ($productos as $key => $producto) {
            $pedido_producto[] = [
                'pedido_id' => $id,
                'producto_id' => $producto['id'],
                'cantidad' => $producto['cantidad'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        //Almacenar en la BD
        PedidoProducto::insert($pedido_producto);
        
        return[
            "message" => "Pedido realizado, estará listo en unos minutos",
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pedido $pedido)
    {
        $pedido->estado = 1;
        $pedido->save();
        $id = $pedido->id;
        return [
            'pedido' => $pedido,
            'message' => "Pedido #$id cerrado correctamente." 
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
        //
    }
}
