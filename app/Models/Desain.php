<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Desain extends Model
{
    protected $fillable = [
    'title',
    'image',
    'link',
    ];

    protected function imageUrl(): Attribute
    {
        return Attribute::get(fn () => Storage::disk('supabase')->url($this->image));
    }
}
