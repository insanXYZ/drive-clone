<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class File extends Model
{
    use HasFactory , HasUuids;

    protected $keyType = "string";
    public $incrementing = false;

    public $guarded = ["id"];

    public function user()
    {
        return $this->belongsTo(User::class , "user_id");
    }
}