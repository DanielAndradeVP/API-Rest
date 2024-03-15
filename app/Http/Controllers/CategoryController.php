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
        // Busca todas as categorias existentes
        $categories = Category::all();

        // Retorna uma resposta
        return response()->json([
            'data' => $categories, 
            Response::HTTP_OK]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(StoreCategoryRequest $request)
    {
        // Valida e cria categoria
        $category = Category::create($request->validated());
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
        // Valida se a categoria existe
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
        // Valida se a categoria existe
        $category = Category::find($id);
        if (! $category) {
            return response()->json(
                ['message' => 'Category does not exist'],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        // Valida os campos obrigatórios do payload
        $data = $request->validated();

        // Atualiza a categoria validada
        $category->update($data);
        if (! $category) {
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
        // Valida se a categoria existe
        $category = Category::find($id);
        if (! $category) {
            return response()->json([
                'message' => 'Category not exist'],
                Response::HTTP_NOT_FOUND);
        }

        // Deleta a categoria
        $category->delete();
        return response()->json([
            'message' => 'Deleted sucessfully'],
            Response::HTTP_OK);
    }
}
