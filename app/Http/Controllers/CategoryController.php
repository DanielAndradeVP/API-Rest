<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        // Define o limite da consulta
        $categories = Category::all();

        // Retorna uma resposta
        return response()->json($categories, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(StoreCategoryRequest $request)
    {
        // Valida o produto

        // Armazenar no banco de dados
        $category = Category::create($request->all());
        if (! $category) {
            return response()->json([
                'message' => 'Category not created'],
                Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Retorna um resposta
        return response()->json([
            'message' => 'Sucessfully created',
            'data' => $category, ],
            Response::HTTP_CREATED);
    }

    public function show(int $id)
    {
        // Valida se o produto existe
        $category = Category::find($id);
        if (! $category) {
            return response()->json([
                'message' => 'Category not found'],
                Response::HTTP_NOT_FOUND);
        }
        $category->products;

        // Retorna uma resposta
        return Response()->json([
            'data' => $category,
            Response::HTTP_OK]);
    }

    public function update(UpdateCategoryRequest $request, $id): JsonResponse
    {
        // Valida se o produto existe
        $data = $request->validated();
        $category = Category::find($id);

        if (! $category) {
            return response()->json(
                ['message' => 'Category does not exist'],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        // Valida a atualização
        $response = $category->update($data);
        if (! $response) {
            return response()->json([
                'message' => 'Error to the update the category.'],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        // Retorna uma resposta
        return response()->json([
            'message' => 'Updated sucessfully',
            'data' => $category,
        ], Response::HTTP_OK);

    }

    public function destroy($id): JsonResponse
    {
        // Valida se o produto existe
        $category = Category::find($id);

        if (! $category) {

            return response()->json([
                'message' => 'Category not exist'],
                Response::HTTP_NOT_FOUND);
        }

        // Deleta o produto
        $category->delete();

        return response()->json([
            'message' => 'Deleted sucessfully'],
            Response::HTTP_OK);
    }
}
