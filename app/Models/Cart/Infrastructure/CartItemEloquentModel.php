<?php

namespace App\Models\Cart\Infrastructure;

use App\Models\Products\Infrastructure\ProductEloquentModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $cart_id
 * @property int $product_id
 * @property int $quantity
 *
 * @method static create(array $array)
 * @method static find($id)
 * @method static select(string[] $array)
 */
final class CartItemEloquentModel extends Model
{
    protected $table = 'cart_items';

    protected $primaryKey = 'id';

    protected $fillable = ['cart_id', 'product_id', 'quantity'];

    public function cart(): BelongsTo
    {
        return $this->belongsTo(CartEloquentModel::class);
    }

    public function product(): HasOne
    {
        return $this->hasOne(ProductEloquentModel::class);
    }

    public function id(): string
    {
        return $this->id;
    }

    public function quantity(): int
    {
        return $this->quantity;
    }
}
