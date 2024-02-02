<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Date;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'starting_date',
        'ending_date',
        'tags',
        'is_public',
        'price',
        'user_id',
        'category_id',
        'thumbnail'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Comment::class);
    }


    protected function startingDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? (new DateTime($value))->format('d-m-Y') : null,
        );
    }


//    public function getTitle($value)
//    {
//        return ucfirst('testrtrt');
////        return ucfirst($value->format('d/m/Y'));
//    }

}
