<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LicencaRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Licenca;

class LicencaController extends Controller
{
    public function index()
    {
      try{
        $licencas = Licenca::all();
      } catch (\Exception $e){
        return response([
          'error' => true,
          'msg' => 'Unknown error',
        ], 403);
      }

      if($licencas->count() === 0) return ['empty' => true];

      return $licencas;
    }


    public function create()
    {
        //
    }


    public function store(LicencaRequest $request)
    {
      try {
        $licenca = Licenca::create($request->all());
      } catch (ModelNotFoundException $e){
        return response([
          'error' => true,
          'msg' => 'Cliente Id not found',
        ], 404);
      } catch (\Exception $e){
        return response([
          'error' => true,
          'msg' => 'Unknown error',
        ], 403);
      }

      return $licenca;
    }

    public function show($id)
    {
      try{
        $licenca = Licenca::findOrFail($id);
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

      return $licenca;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function update(LicencaRequest $request, $id)
    {
      try {
        $licenca = Licenca::findOrFail($id);
        $licenca->update($request->all());
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

      return $licenca;
    }


    public function destroy($id)
    {
      try{
        $licenca = Licenca::findOrFail($id);
        $licenca->delete();
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

      return ['deleted' => $licenca->licenca_id];
    }
}
