<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Printag extends Model
{
    use HasFactory, HasUuids;
    protected $guarded = [];

    public function loading() {
        return $this->belongsTo(Loading::class, 'id_loading');
    }

    public function packing() {
        return $this->belongsTo(Packing::class, 'id_packing');
    }

    public static function show_by_id($id) {
        return Self::with(['loading.user','loading.planing','packing'])->whereHas('loading', function ($query) use ($id) {
            $query->where('user_id', $id);
        })
        ->latest()->get();
    }

    public static function show_id_packing() {
        return Self::with(['packing.loading.user', 'packing.loading.planing.user'])->whereHas('packing', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->latest()->get();
    }
}
