<?php

namespace App\Models\Auth\Traits\Scope;

/**
 * Class UserScope.
 */
trait UserScope
{
    /**
     * @param $query
     * @param bool $confirmed
     *
     * @return mixed
     */
    public function scopeConfirmed($query, $confirmed = 1)
    {
        return $query->where('confirmed', $confirmed);
    }

    /**
     * @param $query
     * @param bool $status
     *
     * @return mixed
     */
    public function scopeActive($query, $status = 1)
    {
        return $query->where('active', $status);
    }
}
