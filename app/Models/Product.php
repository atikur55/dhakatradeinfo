<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function connect_business()
    {
        return $this->belongsTo(BusinessType::class,'business_id');
    }
    public function connect_category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function connect_subcategory()
    {
        return $this->belongsTo(SubCategory::class,'subcategory_id');
    }
    public function connect_childcategory()
    {
        return $this->belongsTo(ChildCategory::class,'childcategory_id');
    }
}
