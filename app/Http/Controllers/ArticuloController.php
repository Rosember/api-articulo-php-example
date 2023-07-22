<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Articulo;
use Illuminate\support\Facades\Log;

class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = Articulo::get();
            return response()->json($data,200);
        } catch (\Throwable $th) {
            return response()->json(['error'=>$th->getMessage()],500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $articulo = new Articulo();
        // $articulo->descripcion = $request->descripcion;
        // $articulo->precio = $request->precio;
        // $articulo->stock = $request->stock;
        // $articulo->save();

        try {
            $data['descripcion']= $request['descripcion'];
            $data['precio']= $request['precio'];
            $data['stock']= $request['stock'];
            $res = Articulo::create($data);
            return response()->json($res,200);
        } catch (\Throwable $th) {
            return response()->json(['error'=>$th->getMessage()],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show( string $id)
    {
        try {
            $data = Articulo::find($id);
            return response()->json($data,200);
        } catch (\Throwable $th) {
            return response()->json(['error'=>$th->getMessage()],500);
        }
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
        // $articulo = Articulo::findOrFail($request->id);
        // $articulo->descripcion = $request->descripcion;
        // $articulo->precio = $request->precio;
        // $articulo->stock = $request->stock;

        // $articulo->save();

        // return $articulo;

        try {
            $data['descripcion']= $request['descripcion'];
            $data['precio']= $request['precio'];
            $data['stock']= $request['stock'];
            Log::channel('custom')->info("Datos del array: ".'--'.print_r($data, true));
            Log::info('This is some useful information' .' --'.  $data['descripcion']);
            Articulo::find($id).update($data);
            $res = Articulo::find($id);
            return response()->json($res,200);
            
        } catch (\Throwable $th) {
            
            return response()->json([
                'error'=>$th->getMessage(),
                'linea'=> $th->getLine()
                ]
                ,500); 
        } 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $res = Articulo::find($id)->delete();
            return response()->json(['deleted'=>$res],200);
        } catch (\Throwable $th) {
            return response()->json(['error'=>$th->getMessage()],500);
        }
    }
}
