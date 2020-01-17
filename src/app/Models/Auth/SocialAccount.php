<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class SocialAccount.
 */
class SocialAccount extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'social_accounts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'provider', 'provider_id', 'token', 'avatar'];
}
