<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = ['titulo', 'texto', 'bloqueado', 'dataFantasia'];


    public function usuario(){
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function categoria(){
    	return $this->belongsTo(Categoria::class);
    }

    public function imagens(){
    	return $this->hasMany(Imagem::class);
    }

    public function imagemDestaque(){
        return $this->imagens()->where('imagemDestaque', 1)->first();
    }

    public function deletarImagens(){
      try{
        foreach($this->imagens as $imagem){
          $imagem->delete();
        }
      } catch (\Exception $e) {
        throw $e;
      }
    }
}
