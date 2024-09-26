<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::paginate(20);

        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request)
    {
        Client::create($request->validated());

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        $client->update($request->validated());

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return back();
    }

    public function recycleBin()
    {
        $clients = Client::onlyTrashed()->paginate(10);
        return view('clients.recycleBin', compact('clients'));
    }

    public function restore($id)
    {
        $client = Client::onlyTrashed()->where('id', $id)->first();
        $client->restore();
        return back();
    }

    public function restoreAll()
    {
        Client::onlyTrashed()->restore();
        return back();
    }

    public function destroyForce($id)
    {
        $client = Client::onlyTrashed()->where('id', $id)->first();
        $client->forceDelete();
        return back();
    }

    public function destroyForceAll()
    {
        Client::onlyTrashed()->forceDelete();
        return back();
    }
}
