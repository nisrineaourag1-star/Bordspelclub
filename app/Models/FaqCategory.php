<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FaqCategory extends Model
{
    protected $fillable = [
        'name',
    ];

    /**
     * One-to-many: een categorie heeft meerdere FAQ-items.
     */
    public function items(): HasMany
    {
        return $this->hasMany(FaqItem::class);
    }
}
