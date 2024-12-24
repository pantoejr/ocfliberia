<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Exception;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function index()
    {
        $currencies = Currency::all();
        return view('currencies.index', [
            'title' => 'List of Currencies',
            'currencies' => $currencies
        ]);
    }

    public function create()
    {
        return view('currencies.create', [
            'title' => 'Create Currency',
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate();
        } catch (Exception $ex) {
            return back()->with('msg', 'Error: ' . $ex->getMessage())->with('flag', 'alert-danger');
        }
    }
}
