<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
	use HasFactory;

	// ...existing code...
	public function catalogs()
	{
		return $this->hasMany(Catalog::class);
	}
	// ...existing code...
}
