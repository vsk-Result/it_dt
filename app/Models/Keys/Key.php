<?php

namespace App\Models\Keys;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Key extends Model
{
    use SoftDeletes;

    protected $table = 'key_collection';

//    protected $dates = ['deleted_at', 'expire_date'];
    protected $dates = ['deleted_at'];

    protected $fillable = ['user_id', 'key', 'login', 'password', 'product', 'expire_date', 'renewal_id', 'is_renewal_use'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function renewal()
    {
        return $this->belongsTo(self::class, 'renewal_id');
    }

    public function usages()
    {
        return $this->hasMany(Usage::class, 'key_id');
    }

    public function getRenewal()
    {
        if (is_null($this->renewal_id)) {
            return 'Использован';
        }

        if ($this->renewal_id == 999999) {
            $renewal = 'Новый';
        } else {
            $renewal = $this->renewal->login;
        }

        return $renewal;
    }

    public function getExpireDays()
    {
        return Carbon::now()->diffInDays($this->expire_date) + 2;
    }

    public function getExpirePercent()
    {
        $general = $this->created_at->diffInDays($this->expire_date) + 2;
        return round($this->getExpireDays() / $general * 100, 0);
    }

    public function getHiddenPassword()
    {
        return str_repeat("*", strlen($this->password));
    }

    public function isRenewalUse()
    {
        return $this->is_renewal_use;
    }

    public static function scopeActive($query)
    {
        return $query->where('is_renewal_use', false);
    }

    public static function getActiveList()
    {
        $list = [];
        $keys = self::active()->with('usages')->get();
        foreach ($keys as $key) {
            $list[$key->id] = '#' . $key->id . ' ' . $key->login;
        }

        return $list;
    }
}
