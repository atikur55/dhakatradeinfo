<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function connect_category()
    {
        return $this->belongsTo(Category::class ,'category_id');
    }
    public function connect_sub_category()
    {
        return $this->belongsTo(SubCategory::class ,'subcategory_id');
    }
}
