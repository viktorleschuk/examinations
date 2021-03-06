<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /**
     * @var string
     */
    protected $table = 'countries';

    /**
     * @var array
     */
    protected $fillable = [
        'code', 'name'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function participants()
    {
        return $this->hasMany('App\Models\Participant');
    }
}
