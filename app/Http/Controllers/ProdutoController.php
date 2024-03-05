<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Produtos;
use App\Models\User;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * OK Exiba uma listagem do recurso.
     */
    public function index()
    {
        return Produtos::all();
    }

    /**
     * OK Mostre o formulário para criação de um novo recurso.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        return Produtos::create($data);

    }

    /**
     * OK Armazene um recurso recém-criado no armazenamento.
     */
    public function show(int $id)
    {
       $produto = Produtos::find($id);
       if($produto){
        return $produto;
       }
       return response()->json(['data'=> 'Produto não existe']);
        
    }

    /**
     * QUASE Atualize o recurso especificado no armazenamento.
     */
    public function update(Request $request,$id)
    {
        $produto = Produtos::find($id);

        if($produto){
            $produto->update($request->all());
            return response()->json([
                'data'=> 'Atualizado com sucesso', 
                'produto' => $produto->toArray()
    ]);
            }
            return response()->json(['data'=> 'Produto não existe']);
    }

    /**
     * QUASE Remova o recurso especificado do armazenamento.
     */
    public function destroy($id)
    {
        $produto = Produtos::find($id);

        if($produto){
        $produto->delete();
        return response()->json(['data'=> 'Deletado com sucesso']);
        }
        return response()->json(['data'=> 'Produto não existe']);
    }
}
