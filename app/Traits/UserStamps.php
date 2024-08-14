<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait UserStamps
{
    public static function bootUserStamps()
    {
        static::creating(function ($model) {
            if (!$model->isDirty('created_by')) {
                $model->created_by = Auth::id();
            }
        });

        static::updating(function ($model) {
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = Auth::id();
            }
        });

        static::deleting(function ($model) {
            if (!$model->isDirty('deleted_by')) {
                $model->deleted_by = Auth::id();
                $model->save();
            }
        });
    }
}