<?php

namespace App\Models\Cart\Infrastructure;

use Illuminate\Database\Eloquent\Model;

final class ProductCartItemModel extends Model
{
    protected $table = 'cart_items';

    protected $primaryKey = 'id';

    protected $fillable = ['cart_id', 'product_id', 'quantity', 'image'];
}
