<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $clients = Client::orderBy('id', 'desc')->get();

            if ($clients->isEmpty()) {
                return response()->json(['error' => 'No clients found'], 404);
            }

            return response()->json(['clients' => $clients], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'logo' => 'required|mimes:png,jpg,jpeg|max:2048',
            'website' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        try {
            $client = Client::create($request->all());

            return response()->json(['message' => 'Client added successfully', 'client' => $client], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error, failed to create client'], 500);
        }
    }

    public function show(string $id)
    {
        try {
            $client = Client::findOrFail($id);

            return response()->json(['client' => $client], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'No client found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'logo' => 'required|mimes:png,jpg,jpeg|max:2048',
            'website' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        try {
            $client = Client::findOrFail($id);

            $client->update($request->all());

            return response()->json(['message' => 'Client updated successfully', 'client' => $client], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'No client found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error, failed to update client'], 500);
        }
    }

    public function destroy(Request $request)
    {
        $clientIds = $request->id;

        try {
            foreach ($clientIds as $clientId) {
                $client = Client::findOrFail($clientId);
                $client->delete();
            }

            return response()->json(['message' => 'Clients removed successfully'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'One or more clients not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error, failed to remove clients'], 500);
        }
    }
}
