<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class Session
 * package App.
 */
class Session extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sessions';

    /**
     * @var array
     */
    protected $guarded = ['*'];
}
