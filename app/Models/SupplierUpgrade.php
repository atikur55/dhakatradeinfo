<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierUpgrade extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function connect_template_category()
    {
        return $this->belongsTo(TemplateCategory::class ,'template_category_id');
    }
    public function connect_template()
    {
        return $this->belongsTo(Template::class ,'temp_id');
    }
}
