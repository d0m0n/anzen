<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    protected $fillable = [
        'provider_id',
        'status_id',
        'county_name',
        'location_name',
        'copy',
        'description',
        'price',
        'note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'county_name', 'country_name_jp');
    }
}
