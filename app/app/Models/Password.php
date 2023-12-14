<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Password extends Model
{
    use HasFactory;

    protected $fillable = ['site', 'login', 'password', 'user_id'];

    protected $casts = [
        'password' => 'encrypted',
    ];

    public function users(): BelongsTo {
        return $this->belongsTo(User::class);
    }
    
    public function teams(): BelongsToMany {
        return $this->belongsToMany(Team::class);
    }
}
