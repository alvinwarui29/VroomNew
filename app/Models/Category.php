<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];
    // Category.php

public function tours()
{
    return $this->hasMany(Product::class, 'category_id');
}

}
