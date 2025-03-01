<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /** @use HasFactory<\Database\Factories\ProfileFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id',
        'bio',
        'cnic',
        'city',
        'country',
        'phone_number',
        'facebook_link',
        'twitter_link',
        'instagram_link',
        'linkedin_link',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
