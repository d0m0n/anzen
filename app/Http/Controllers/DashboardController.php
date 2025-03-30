<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Status;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
	public function index()
	{
		$catalogs = Catalog::all();
		$statuses = Status::all();

		return view('dashboard', compact('catalogs', 'statuses'));
	}
}
