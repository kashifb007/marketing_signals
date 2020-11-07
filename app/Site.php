<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uri', 'title', 'source_code', 'description', 'logo', 'status_code', 'session_id', 'decision', 'notes'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created' => 'datetime',
        'modified' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function session()
    {
        return $this->belongsTo(Session::class)->withDefault();
    }
}
