<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index()
    {
        $catalogs = Catalog::with('user')->latest()->get();
        return view('catalogs.index', compact('catalogs'));
    }

    public function create()
    {
        return view('catalogs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'provider_id' => 'required|integer',
            'status_id' => 'required|integer',
            'county_name' => 'required|string',
            'location_name' => 'required|string',
            'copy' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'note' => 'nullable|string',
        ]);

        Catalog::create($validated);
        return redirect()->route('dashboard')->with('success', '新しいカタログが作成されました！');
    }

    public function show(Catalog $catalog)
    {
        return view('catalogs.show', compact('catalog'));
    }

    public function dashboard()
    {
        $catalogs = Catalog::with('provider')->latest()->get();
        return view('dashboard', compact('catalogs'));
    }
}
