<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loading extends Model
{
    use HasFactory,HasUuids;

    protected $guarded = [];

    public function planing(){
        return $this->belongsTo(Planing::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public static function show_all() {
        return Self::with('planing.user','user')->latest()->get();
    }

    public static function show_by_id($id) {
        return Self::with('user')->where('id', $id)->latest()->get();
    }

    public static function tambah($data) {
        return Loading::create($data);
    }

    public static function ubah($id, $data) {
        return Loading::find($id)->update($data);
    }

    public static function hapus($id) {
        return Loading::find($id)->delete();
    }
}
