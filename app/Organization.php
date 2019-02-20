<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'logo', 'bank', 'bank_card', 'address', 'status', 'reason', 'user_id'
    ];

    public function teacher()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    // public function info($id)
    // {
    //     // return $this
    // }
}
