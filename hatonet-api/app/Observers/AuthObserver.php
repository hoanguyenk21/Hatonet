<?php

namespace App\Observers;

use App\Models\Taxonomy;
use Illuminate\Support\Facades\Auth;

class AuthObserver
{
    public function creating(Taxonomy $model) {
        // $model->user_id = Auth::id();
        // $model->save();
        // return $model;
    }
}
