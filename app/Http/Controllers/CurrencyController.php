<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            $request->validate([
                'name' => 'required'
            ]);
            Currency::create([
                'name' => $request->input('name'),
                'created_by' => Auth::user()->name,
            ]);
            return redirect('currencies')->with('msg', 'Currency created successfully')->with('flag', 'alert-success');
        } catch (Exception $ex) {
            return back()->with('msg', 'Error: ' . $ex->getMessage())->with('flag', 'alert-danger');
        }
    }

    public function edit($id)
    {
        $currency = Currency::findOrFail($id);
        return view('currencies.edit', [
            'title' => 'Edit Currency',
            'currency' => $currency,
        ]);
    }

    public function update(Request $request, $id)
    {
        $currency = Currency::findOrFail($id);
        if (isset($currency)) {
            $currency->name = $request->input('name');
        } else {
            return back()
                ->with('msg', 'Error updating currency')
                ->with('flag', 'alert-danger');
        }
        $currency->save();
        return redirect()->route('currencies.index')
            ->with('msg', 'Currency updated successfully')
            ->with('flag', 'alert-success');
    }

    public function destroy($id)
    {
        $currency = Currency::findOrFail($id);
        $currency->delete();
        return redirect()->route('currencies.index')
            ->with('msg', 'Currency deleted successfully')
            ->with('flag', 'alert-success');
    }
}
