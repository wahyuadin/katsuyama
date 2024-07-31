<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packing extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [];

    public function loading(){
        return $this->belongsTo(Loading::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public static function show_all() {
        return Self::with('loading.user', 'user', 'loading.hanger', 'loading.planing.user')->latest()->get();
    }

    public static function show_by_id($id) {
        return Self::with('user','loading.user','loading.hangger')->where('user_id', $id)->latest()->get();
    }

    public static function printag() {
        return Self::with('loading.user','loading.planing.user','user')->latest()->get();
    }

    public static function tambah($data) {
        return Packing::create($data);
    }

    public static function ubah($id, $data) {
        return Packing::find($id)->update($data);
    }

    public static function hapus($id) {
        return Packing::find($id)->delete();
    }
}
