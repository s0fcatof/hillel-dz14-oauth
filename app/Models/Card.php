<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    public function column()
    {
        return $this->belongsTo(Column::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function executor()
    {
        return $this->belongsTo(User::class, 'executor_id');
    }
}
