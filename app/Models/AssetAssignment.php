<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssetAssignment extends Model
{
    use HasFactory;
            /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "asset_id",
        "assignment_date",
        "status",
        "is_due",
        "due_date",
        "assigned_user_id",
        "assigned_by",
    ];

    // user relationship
    public function user(){
        return $this->belongsTo(User::class, 'assigned_user_id');
    }
}
