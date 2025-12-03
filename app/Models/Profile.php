<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

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
        'address'
    ];

    private function isEncrypted($value)
    {
        try {
            Crypt::decryptString($value);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function setAddressAttribute($value)
    {
        if (!$value) {
            $this->attributes['address'] = null;
            return;
        }
        $this->attributes['address'] = Crypt::encryptString($value);
    }

    public function getAddressAttribute($value)
    {
        if (!$value) return null;
        if ($this->isEncrypted($value)) {
            return Crypt::decryptString($value);
        }
        return $value;
    }

    public function getBioAttribute($value)
    {
        if (!$value) return null;
        if ($this->isEncrypted($value)) {
            return Crypt::decryptString($value);
        }
        return $value;
    }

    public function setBioAttribute($value)
    {
        if (!$value) {
            $this->attributes['bio'] = null;
            return;
        }
        $this->attributes['bio'] = Crypt::encryptString($value);
    }

    public function getCnicAttribute($value)
    {
        if (!$value) return null;
        if ($this->isEncrypted($value)) {
            return Crypt::decryptString($value);
        }
        return $value;
    }

    public function setCnicAttribute($value)
    {
        if (!$value) {
            $this->attributes['cnic'] = null;
            return;
        }
        if (!$this->isEncrypted($value)) {
            $this->attributes['cnic'] = Crypt::encryptString($value);
        } else {
            $this->attributes['cnic'] = $value;
        }
    }

    public function getCityAttribute($value)
    {
        if (!$value) return null;
        if ($this->isEncrypted($value)) {
            return Crypt::decryptString($value);
        }
        return $value;
    }

    public function setCityAttribute($value)
    {
        if (!$value) {
            $this->attributes['city'] = null;
            return;
        }
        if (!$this->isEncrypted($value)) {
            $this->attributes['city'] = Crypt::encryptString($value);
        } else {
            $this->attributes['city'] = $value;
        }
    }

    public function getCountryAttribute($value)
    {
        if (!$value) return null;
        if ($this->isEncrypted($value)) {
            return Crypt::decryptString($value);
        }
        return $value;
    }

    public function setCountryAttribute($value)
    {
        if (!$value) {
            $this->attributes['country'] = null;
            return;
        }
        if (!$this->isEncrypted($value)) {
            $this->attributes['country'] = Crypt::encryptString($value);
        } else {
            $this->attributes['country'] = $value;
        }
    }

    public function getPhoneNumberAttribute($value)
    {
        if (!$value) return null;
        if ($this->isEncrypted($value)) {
            return Crypt::decryptString($value);
        }
        return $value;
    }

    public function setPhoneNumberAttribute($value)
    {
        if (!$value) {
            $this->attributes['phone_number'] = null;
            return;
        }
        if (!$this->isEncrypted($value)) {
            $this->attributes['phone_number'] = Crypt::encryptString($value);
        } else {
            $this->attributes['phone_number'] = $value;
        }
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
