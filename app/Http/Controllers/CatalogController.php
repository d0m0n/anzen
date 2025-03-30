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
        // バリデーション
        $validated = $request->validate([
            'provider_id' => 'required|integer',
            'status_id' => 'required|integer',
            'county_name' => 'required|string|max:255',
            'location_name' => 'required|string|max:255',
            'copy' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'note' => 'nullable|string',
        ]);

        // データ保存
        Catalog::create($validated);

        // リダイレクト
        return redirect()->route('catalogs.index')->with('success', 'カタログが作成されました。');
    }

    public function show($id)
    {
        $catalog = Catalog::with(['provider', 'status'])->findOrFail($id);

        // 必要なデータを取得
        $company_name = $catalog->provider->company_name ?? '不明';
        $location = $catalog->provider->location ?? '不明';
        $phone_number = $catalog->provider->phone_number ?? '不明';
        $fax_number = $catalog->provider->fax_number ?? '不明';
        $url = $catalog->provider->url ?? '不明';

        // ビューにデータを渡す
        return view('catalogs.show', compact('catalog', 'company_name', 'location', 'phone_number', 'fax_number', 'url'));
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
        $url = $provider->url ?? '不明';

        // カタログ情報を取得
        $catalogs = Catalog::where('provider_id', $provider_id)->with('user')->get();

        // カタログに関連するユーザーのURLを取得
        $userUrls = $catalogs->map(function ($catalog) {
            return $catalog->user->url ?? '不明';
        });

        // ビューにデータを渡す
        return view('catalogs.provider_list', [
            'catalogs' => $catalogs,
            'providerName' => $provider->name ?? '不明', // Userのnameを取得
            'company_name' => $company_name,
            'location' => $location,
            'phone_number' => $phone_number,
            'fax_number' => $fax_number,
            'url' => $url,
            'userUrls' => $userUrls, // ユーザーのURLリストを渡す
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

    public function showProviderList($providerId)
    {
        $provider = Provider::findOrFail($providerId);
        $catalogs = $provider->catalogs;
        $url = $provider->homepage_url; // プロバイダーのホームページURLを取得

        return view('catalogs.provider_list', [
            'providerName' => $provider->name,
            'company_name' => $provider->company_name,
            'location' => $provider->location,
            'phone_number' => $provider->phone_number,
            'fax_number' => $provider->fax_number,
            'url' => $url, // ここで渡す
            'catalogs' => $catalogs,
        ]);
    }

    public function edit(Catalog $catalog)
    {
        return view('catalogs.edit', compact('catalog'));
    }

    public function update(Request $request, Catalog $catalog)
    {
        $validated = $request->validate([
            'provider_id' => 'required|integer',
            'status_id' => 'required|integer',
            'county_name' => 'required|string|max:255',
            'location_name' => 'required|string|max:255',
            'copy' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'note' => 'nullable|string',
        ]);

        $catalog->update($validated);

        return redirect()->route('dashboard')->with('success', 'Catalog updated successfully.');
    }

    public function destroy($provider_id)
    {
        $catalog = Catalog::where('provider_id', $provider_id)->first();

        if ($catalog) {
            $catalog->delete();
            return redirect()->route('catalogs.index')->with('success', 'カタログが削除されました。');
        }

        return redirect()->route('catalogs.index')->with('error', 'カタログが見つかりませんでした。');
    }
}
