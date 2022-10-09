<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClienteRequest;
use App\Cliente;

class ClienteController extends Controller
{
    // TODO: Add Try Catches...
    public function index()
    {
      $clientes = Cliente::with('endereco')->get();

      return ($clientes->count() === 0) ? ['empty' => true] : $clientes;
    }

    public function create()
    {
        //
    }

    public function store(ClienteRequest $request)
    {
      // TODO - Implementar verificação de campos
      return Cliente::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      try{
        $cliente = Cliente::with('endereco')->findOrFail($id);
      } catch (ModelNotFoundException $e){
        return response([
          'error' => true,
          'msg' => 'Id not found',
        ], 404);
      } catch (\Exception $e){
        return response([
          'error' => true,
          'msg' => 'Unknown error',
        ], 403);
      }

      return $cliente;
    }

    public function edit($id)
    {
        //
    }


    public function update(ClienteRequest $request, $id)
    {
      try{
        $cliente = Cliente::findOrFail($id);
        $cliente->update($request->all());
      } catch (ModelNotFoundException $e){
        return response([
          'error' => true,
          'msg' => 'Id not found',
        ], 404);
      } catch (\Exception $e){
        return response([
          'error' => true,
          'msg' => 'Unknown error',
        ], 403);
      }

      return $cliente;
    }

     public function destroy($id)
     {
       try{
         $cliente = Cliente::findOrFail($id);
         $cliente->delete();
       } catch (ModelNotFoundException $e){
         return response([
           'error' => true,
           'msg' => 'Id not found',
         ], 404);
       } catch (\Exception $e){
         return response([
           'error' => true,
           'msg' => 'Unknown error',
         ], 403);
       }


       return ['deleted' => $cliente->cliente_id];
     }
}
