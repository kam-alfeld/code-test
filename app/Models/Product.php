<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image'
    ];

    protected $guarded = [];

    public function creator() {
        return $this->belongsTo(User::class, "created_by");
    }

    public function attachedUsers() {
        return $this->belongsToMany(User::class, "user_product");
    }
}
