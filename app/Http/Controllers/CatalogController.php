<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Status; // 必要に応じて追加
use Illuminate\Http\Request;
use App\Models\User; // Userモデルをインポート

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

        if ($request->filled('status_id')) {
            $query->where('status_id', $request->status_id); // status_id で絞り込み
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
        $statuses = Status::all(); // ステータスを取得

        // ビューにデータを渡す
        return view('catalogs.index', [
            'catalogs' => $catalogs,
            'countries' => $countries,
            'locations' => $locations,
            'statuses' => $statuses, // 追加
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

    public function filterByProvider($provider_id)
    {
        $catalogs = Catalog::where('provider_id', $provider_id)->get();
        $provider = User::find($provider_id); // Userモデルを使用

        return view('catalogs.index', [
            'catalogs' => $catalogs,
            'countries' => Country::all()->pluck('name'),
            'locations' => Location::all()->pluck('name'),
            'statuses' => Status::all(),
            'providerName' => $provider->name ?? '不明', // Userのnameを取得
        ]);
    }

    public function providerCatalogs($provider_id)
    {
        // プロバイダー情報を取得
        $provider = User::find($provider_id); // Userモデルを使用

        // 追加: プロバイダー情報が存在する場合に詳細を取得
        $company_name = $provider->company_name ?? '不明';
        $location = $provider->location ?? '不明';
        $phone_number = $provider->phone_number ?? '不明';
        $fax_number = $provider->fax_number ?? '不明';

        // カタログ情報を取得
        $catalogs = Catalog::where('provider_id', $provider_id)->get();

        // ビューにデータを渡す
        return view('catalogs.provider_list', [
            'catalogs' => $catalogs,
            'providerName' => $provider->name ?? '不明', // Userのnameを取得
            'company_name' => $company_name,
            'location' => $location,
            'phone_number' => $phone_number,
            'fax_number' => $fax_number,
        ]);
    }

    public function providerList($providerId)
    {
        // 追加: データベースから会社情報を取得
        $provider = Provider::findOrFail($providerId);
        $company_name = $provider->company_name;
        $location = $provider->location;
        $phone_number = $provider->phone_number;
        $fax_number = $provider->fax_number;

        // ビューにデータを渡す
        return view('catalogs.provider_list', [
            'providerName' => $provider->name,
            'catalogs' => $provider->catalogs,
            'company_name' => $company_name,
            'location' => $location,
            'phone_number' => $phone_number,
            'fax_number' => $fax_number,
        ]);
    }
}
