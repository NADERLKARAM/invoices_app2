<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function Section() {
        return $this->belongsTo(sections::class);
    }
    protected $fillable = ['Product_name', 'description', 'section_id'];
}