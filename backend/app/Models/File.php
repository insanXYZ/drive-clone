<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use HasFactory , HasUuids , SoftDeletes;

    protected $keyType = "string";
    public $incrementing = false;

    public $guarded = ["id"];

    public function user()
    {
        return $this->belongsTo(User::class , "user_id");
    }
}