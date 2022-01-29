<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;
        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "type",
        "serial_no",
        "description",
        "fixed_or_movable",
        "picture_path",
        "purchase_date",
        "start_to_use_date",
        "purchase_price",
        "warranty_expiry_date",
        "degradation_in_years",
        "current_value_in_naira",
        "location"
    ];
}
