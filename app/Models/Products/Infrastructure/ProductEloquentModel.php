<?php

namespace App\Models\Products\Infrastructure;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static find(int $id)
 */
final class ProductEloquentModel extends Model
{
    protected $table = 'products';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'description', 'price'];
}
