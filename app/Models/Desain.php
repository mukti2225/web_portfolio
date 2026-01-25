<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Services\SupabaseStorage;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Desain extends Model
{
    protected function imageUrl(): Attribute
    {
        return Attribute::get(fn () => Storage::disk('supabase')->url($this->image));
    }

    protected $fillable = [
    'title',
    'image',
    'link',
];
}
