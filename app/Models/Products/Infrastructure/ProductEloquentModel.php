<?php

namespace App\Models\Products\Infrastructure;

use App\Models\Cart\Infrastructure\CartItemEloquentModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static find(int $id)
 * @method static create(array $array)
 * @method static first()
 * @property int $id
 */
final class ProductEloquentModel extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'description', 'price', 'image'];

    public function item(): BelongsTo
    {
        return $this->belongsTo(CartItemEloquentModel::class);
    }

    public function id()
    {
        return $this->id;
    }
}
