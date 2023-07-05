<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    protected $fillable = [
        'id',
        'post_id',
        'comment',
        'created_at',
        'updated_at'

    ];

    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class,'id');
    }
}
