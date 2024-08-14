<?php

namespace App\Models;

use App\Traits\UserStamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes, UserStamps;

    protected $fillable = [
        'product_category_id',
        'productName',
        'productImage',
        'productDescription',
        'productPrice',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function productVariant(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function ProductCategory(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function deleter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
