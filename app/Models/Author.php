<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['avatar'];

    public function getAvatarAttribute()
    {
        return 'https://ui-avatars.com/api/?background=random&name=' . $this->name;
    }
}
