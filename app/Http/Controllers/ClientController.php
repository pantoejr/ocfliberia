<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', [
            'clients' => $clients,
            'title' => 'List of Clients',
        ]);
    }

    public function create()
    {
        return view('clients.create', [
            'title' => 'Create Client',
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'phone_number' => 'numeric|required',
                'location' => 'required',
            ]);

            Client::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone_number' => $request->input('phone_number'),
                'location' => $request->input('location'),
                'is_active' => $request->input('is_active') ? 1 : 0,
                'created_by' => Auth::user()->name,
            ]);

            return redirect('clients')->with('msg', 'Client added successfully')
                ->with('flag', 'alert-success');
        } catch (Exception $ex) {
            return back()->withErrors([
                'email' => 'Email is null or invalid',
                'name' => 'Client name cannot be null or empty',
                'phone_number' => 'Phone number cannot be null or empty',
                'location' => 'Location cannot be null or empty'
            ])->with('msg', $ex->getMessage())->with('flag', 'alert-danger');
        }
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('clients.edit', [
            'client' => $client,
            'title' => 'Edit Client'
        ]);
    }

    public function update($id, Request $request)
    {
        $client = Client::findOrFail($id);
    }
}
