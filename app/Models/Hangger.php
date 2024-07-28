<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hangger extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public static function show_all() {
        return Hangger::all();
    }

    public static function show_by_id($id) {
        return Hangger::with('user')->where('user_id', $id)->latest()->get();
    }
}
