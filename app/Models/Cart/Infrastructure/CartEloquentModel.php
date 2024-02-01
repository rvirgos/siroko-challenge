<?php

namespace App\Models\Cart\Infrastructure;

use Illuminate\Database\Eloquent\Model;

final class CartEloquentModel extends Model
{
    protected $table = 'carts';

    protected $primaryKey = 'id';

    protected $fillable = [];
}
