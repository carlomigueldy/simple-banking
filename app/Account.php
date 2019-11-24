<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'user_id',
        'balance',
    ];

    public $timestamps = false;

    /**
     * The Account Holder's user credentials.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
