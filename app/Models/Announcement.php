<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'photo_urls', 'created_by_id'
    ];

    protected $casts = [
        'photo_urls' => 'array'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function getMainPhoto()
    {
        $photos = $this->getAttribute('photo_urls');
        return reset($photos);
    }
}
