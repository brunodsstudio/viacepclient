<?php

namespace App\Http\Controllers;
use App\Models\buscas;
use Illuminate\Http\Request;
use Http;

class apiController extends Controller
{
    public function index(Request $request){

        if(isset($request->cep)){
            if($request->cep !== ""){          
            $res = Http::get('https://viacep.com.br/ws/'.str_replace("-", "", $request->cep).'/json/');
            return response()->json(json_decode($res->body()), 200);
            
        }
    }
}

    public function buscas(){
        $buscas = buscas::select("cep", "logradouro", "bairro", "complemento", "localidade", "id")->get();
        return response()->json($buscas, 200);

    }

    public function deletebusca(Request $request){
       $buscas = buscas::where('id', $request->id)->delete();
        return response()->json($buscas, 200);
    }

    public function insertbuscas(Request $request){

        if(trim($request->logradouro) !== ""){
        $busca = new buscas();
        $busca->cep = $request->cep;
        $busca->logradouro = $request->logradouro;
        $busca->bairro = $request->bairro;
        $busca->complemento = $request->complemento;
        $busca->localidade = $request->localidade;
        $busca->user_id = 1;
        $busca->save();
        }

        return response()->json([
            'message' => 'Descricao criado com sucesso!',
            'data' => 'nt',
                ], 200);

    }
}

