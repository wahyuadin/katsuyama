<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Printag extends Model
{
    use HasFactory, HasUuids;
    protected $guarded = [];

    public function loading() {
        return $this->belongsTo(Loading::class, 'id_loading');
    }

    public static function show_by_id($id) {
        return Printag::with(['loading.user','loading.planing'])->whereHas('loading', function ($query) use ($id) {
            $query->where('user_id', $id);
        })->latest()->get();
    }
}
