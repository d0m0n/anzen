<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        // フィルタリング用のリストを生成
        $countries = Catalog::select('county_name')->distinct()->pluck('county_name');
        $locations = Catalog::select('location_name')->distinct()->pluck('location_name');

        // クエリビルダーでフィルタリング
        $query = Catalog::query();

        if ($request->filled('country_name')) {
            $query->where('county_name', $request->country_name);
        }

        if ($request->filled('location_name')) {
            $query->where('location_name', $request->location_name);
        }

        // ソート処理
        if ($request->filled('sort')) {
            if ($request->sort === 'price_asc') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort === 'price_desc') {
                $query->orderBy('price', 'desc');
            }
        }

        $catalogs = $query->get();

        // ビューにデータを渡す
        return view('catalogs.index', [
            'catalogs' => $catalogs,
            'countries' => $countries,
            'locations' => $locations,
        ]);
    }

    public function create()
    {
        return view('catalogs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'provider_id' => 'required|integer|exists:users,id', // 外部キー制約を確認
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
