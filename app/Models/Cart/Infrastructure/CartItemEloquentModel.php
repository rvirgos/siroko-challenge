<?php

namespace App\Models\Cart\Infrastructure;

use App\Models\Products\Infrastructure\ProductEloquentModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
 * @method static where(string $string, string $string1, string $cartId)
 */
final class CartItemEloquentModel extends Model
{
    use HasFactory;

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
