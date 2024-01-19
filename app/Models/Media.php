<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
//        'event_id',
        'thumbnail',
        'type',
    ];

    public function event(): hasMany
    {
        return $this->hasMany(Event::class);
    }

}
