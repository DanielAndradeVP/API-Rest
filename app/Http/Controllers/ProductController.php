<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        // Define o limite da consulta
        $products = Product::paginate(10);

        // Retorna uma resposta
        return response()->json([
            'data' => $products], 
            Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(StoreProductRequest $request): JsonResponse
    {
        // Valida o produto
        $data = $request->validated();

        // Armazenar no banco de dados
        $product = Product::create($data);
        if (! $product) {
            return response()->json([
                'message' => 'Product not created'],
                Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Retorna um resposta
        return response()->json([
            'message' => 'Sucessfully created',
            'data' => $product, ],
            Response::HTTP_CREATED);
    }

    /**
     * Show the specified resource.
     */
    public function show(int $id)
    {
        // Valida se o produto existe
        $product = Product::find($id);
        if (! $product) {
            return response()->json([
                'message' => 'Product not found'],
                Response::HTTP_NOT_FOUND);
        }

        // Retorna uma resposta
        return Response()->json([
            'data' => $product,
            Response::HTTP_OK]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, $id): JsonResponse
    {
        // Valida se o produto existe
        $data = $request->validated();
        $product = Product::find($id);

        if (! $product) {
            return response()->json([
                'message' => 'product does not exist'],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        // Valida a atualização
        $response = $product->update($data);
        if (! $response) {
            return response()->json([
                'message' => 'Error to the update the product.'],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        // Retorna uma resposta
        return response()->json([
            'message' => 'Updated sucessfully',
            'data' => $product],
             Response::HTTP_OK);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        // Valida se o produto existe
        $product = Product::find($id);
        if (! $product) {
            return response()->json([
                'message' => 'Product not exist'],
                Response::HTTP_NOT_FOUND);
        }

        // Deleta o produto
        $product->delete();
        return response()->json([
            'message' => 'Deleted sucessfully'],
            Response::HTTP_OK);
    }
}
