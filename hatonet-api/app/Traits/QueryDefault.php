<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait QueryDefault {

    public static function boot() {
        parent::boot();
        if (Auth::user()) {
            static::saving(function ($model) {
                $model->user_id = Auth::user()->id;
            });
        }
    }
}
