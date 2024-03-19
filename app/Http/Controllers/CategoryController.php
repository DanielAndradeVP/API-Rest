<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Requests\UpdateStatusRequest;
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
            'data' => $categories],
            Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(StoreCategoryRequest $request)
    {
        $dataValidated = $request->validated();

        // Valida e cria categoria
        $category = Category::create($dataValidated);
        if (! $category) {
            return response()->json([
                'message' => 'Category not created'],
                Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        // Retura uma resposta
        return response()->json([
            'message' => 'Successfully created',
            'data' => $category],
            Response::HTTP_CREATED);
    }

    public function show(int $id)
    {
        // Valida de a categoria existe
        $category = Category::find($id);
        if (! $category) {
            return response()->json([
                'message' => 'Category not found'],
                Response::HTTP_NOT_FOUND);
        }

        $category->products;

        // Retorna uma resposta
        return Response()->json([
            'data' => $category],
            Response::HTTP_OK
        );
    }

    public function update(UpdateCategoryRequest $request, $id): JsonResponse
    {
        // Valida que a categoria existe
        $category = Category::find($id);
        if (! $category) {
            return response()->json([
                'message' => 'Category does not exist'],
                Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Valida os campos do payload obrigatórios
        $data = $request->validated();

        // Atualiza a categoria validada
        $category->update($data);
        if (! $category) {
            return response()->json([
                'message' => 'Error to the update the category'],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        // Retorna uma resposta
        return response()->json([
            'message' => 'Updated successfully',
            'data' => $category],
            Response::HTTP_OK);

    }

    public function destroy(int $id): JsonResponse
    {
        // Valida se a categoria existe
        $category = Category::find($id);
        if (! $category) {
            return response()->json([
                'message' => 'Category not exist'],
                Response::HTTP_NOT_FOUND);
        }

        $response = $category->delete();
        if (! $response) {
            return response()->json([
                'message' => 'Error when product delete'],
                Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'message' => 'Deleted successfully'],
            Response::HTTP_OK);
    }

    public function UpdateStatus(UpdateStatusRequest $request, $id)
    {
        // Busca a categoria
        $category = Category::find($id);
        if (! $category) {
            return response()->json([
                'message' => 'Category does not exist'],
                Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Busca o novo status passado no JSON
        $newStatus = $request->status;

        // Atualiza o status da categoria
        $category->status = $newStatus;

        // Salva o novo status da categoria
        if (! $category->save()) {
            return response()->json([
                'message' => 'Error to save category'],
                Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        // Retorna uma resposta
        return response()->json([
            'message' => 'Status updated successfully',
            'data' => $category],
            Response::HTTP_OK);
    }
}
