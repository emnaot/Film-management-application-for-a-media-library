<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class FilmController extends Controller
{
    public function __construct()
    {
        // Ajouter les headers CORS pour toutes les méthodes
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-CSRF-TOKEN, Accept');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        try {
            $films = Film::all();
            return response()->json([
                'success' => true,
                'data' => $films
            ])->header('Access-Control-Allow-Origin', '*');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors du chargement des films',
                'error' => $e->getMessage()
            ], 500)->header('Access-Control-Allow-Origin', '*');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'titre' => 'required|string|max:255',
                'realisateur' => 'required|string|max:255',
                'pays' => 'required|string|max:255',
                'date_sortie' => 'required|date',
                'description' => 'required|string',
                'poster' => 'required|string|max:255',
                'duree' => 'required|integer|min:1',
                'langue' => 'required|string|max:255'
            ]);

            $film = Film::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Film créé avec succès',
                'data' => $film
            ], 201)->header('Access-Control-Allow-Origin', '*');

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur de validation',
                'errors' => $e->errors()
            ], 422)->header('Access-Control-Allow-Origin', '*');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création du film',
                'error' => $e->getMessage()
            ], 500)->header('Access-Control-Allow-Origin', '*');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        try {
            $film = Film::find($id);

            if (!$film) {
                return response()->json([
                    'success' => false,
                    'message' => 'Film non trouvé'
                ], 404)->header('Access-Control-Allow-Origin', '*');
            }

            return response()->json([
                'success' => true,
                'data' => $film
            ])->header('Access-Control-Allow-Origin', '*');
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors du chargement du film',
                'error' => $e->getMessage()
            ], 500)->header('Access-Control-Allow-Origin', '*');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        try {
            $film = Film::find($id);

            if (!$film) {
                return response()->json([
                    'success' => false,
                    'message' => 'Film non trouvé'
                ], 404)->header('Access-Control-Allow-Origin', '*');
            }

            $validatedData = $request->validate([
                'titre' => 'sometimes|required|string|max:255',
                'realisateur' => 'sometimes|required|string|max:255',
                'pays' => 'sometimes|required|string|max:255',
                'date_sortie' => 'sometimes|required|date',
                'description' => 'sometimes|required|string',
                'poster' => 'sometimes|required|string|max:255',
                'duree' => 'sometimes|required|integer|min:1',
                'langue' => 'sometimes|required|string|max:255'
            ]);

            $film->update($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Film mis à jour avec succès',
                'data' => $film->fresh()
            ])->header('Access-Control-Allow-Origin', '*');

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur de validation',
                'errors' => $e->errors()
            ], 422)->header('Access-Control-Allow-Origin', '*');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour du film',
                'error' => $e->getMessage()
            ], 500)->header('Access-Control-Allow-Origin', '*');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $film = Film::find($id);

            if (!$film) {
                return response()->json([
                    'success' => false,
                    'message' => 'Film non trouvé'
                ], 404)->header('Access-Control-Allow-Origin', '*');
            }

            $film->delete();

            return response()->json([
                'success' => true,
                'message' => 'Film supprimé avec succès'
            ])->header('Access-Control-Allow-Origin', '*');
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression du film',
                'error' => $e->getMessage()
            ], 500)->header('Access-Control-Allow-Origin', '*');
        }
    }
}
