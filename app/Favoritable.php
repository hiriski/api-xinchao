<?php

namespace App;

use Illuminate\Http\JsonResponse;
use Auth;

trait Favoritable {
    
    /**
     * Polymorphic relation
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function favorites() {
        return $this->morphMany(\App\Models\Favorite::class, 'favoritable');
    }

    public function addFavorite() {
        $userId = Auth::user()->id;
        if(! $this->favorites()->where('user_id', $userId)->exists()) {
            return $this->favorites()->create([
                'user_id' => $userId
            ]);
        }
    }

    public function removeFavorite() {
        return $this->favorites()->where('user_id', Auth::user()->id)->delete();
    }

    public function getIsFavoritedAttribute() {
        return !! $this->favorites->where('user_id', 1)->count();
    }
}