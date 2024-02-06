<?php

namespace App\Models\Cart\Infrastructure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $array)
 * @method static where(string $column, string $operator, string $value)
 * @method static select(string|array $param)
 * @method static count()
 */
final class CartEloquentModel extends Model
{
    use HasFactory;

    protected $table = 'carts';

    protected $primaryKey = 'id';

    protected $fillable = ['id', 'complete'];

    public function items(): HasMany
    {
        return $this->hasMany(CartItemEloquentModel::class);
    }
}
