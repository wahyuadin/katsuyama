<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory, HasUuids;
    protected $guarded = [];

    public function loading() {
        return $this->belongsTo(Loading::class, 'id_loading');
    }

    public function packing() {
        return $this->belongsTo(Packing::class, 'id_packing');
    }

    public static function show_all() {
        return Report::with('loading.planing','loading.user','loading.hanger','packing.loading', 'packing.user')->latest()->get();
    }

}
