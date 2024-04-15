<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $fillable = ['src', 'alt', 'lot'];
    protected $appends = ['isFlipped'];

    public $timestamps = false;

    /**
     * Get the isFlipped attribute.
     *
     * @return bool
     */
    public function getIsFlippedAttribute(): bool
    {
        return false;
    }

    /**
     * Flip the card.
     *
     * @return void
     */
    public function flipCard(): void
    {
        $this->isFlipped = !$this->isFlipped;
    }
}
