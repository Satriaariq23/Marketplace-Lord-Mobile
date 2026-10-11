<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'castle_level',
        'might',
        'troop_t4',
        'troop_t5',
        'kingdom',
        'account_role',
        'bind_status',
        'migration_ticket_ready',
        'hero_grade',
        'familiar_grade',
        'research_summary',
        'description',
        'price',
        'stock',
        'image_path',
        'video_path',
        'whatsapp_number',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'migration_ticket_ready' => 'boolean',
        'price' => 'integer',
        'stock' => 'integer',
        'castle_level' => 'integer',
        'might' => 'integer',
        'troop_t4' => 'integer',
        'troop_t5' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
