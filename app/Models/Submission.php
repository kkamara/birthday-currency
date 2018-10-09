<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Submission extends Model
{
    /**
     * Immutable values.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * This model relationship has one \App\Models\ExchangeRate.
     *
     * @return  \Illuminate\Database\Eloquent\Model
     */
    public function exchangeRate()
    {
        return $this->hasOne('App\Models\ExchangeRate', 'submission_id');
    }

    /**
     * @param  \Illuminate\Datamase\Eloquent\Model  $query
     * @param  \Illuminate\Http\Request             $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function scopeGetSubmissions($query, $request)
    {
        $search = filter_var($request->input('search'), FILTER_SANITIZE_STRING);

        $query = self::select('*');

        if(!empty($search))
        {
            $query->where('birthday', '=', $search);
        }

        return $query->orderBy('birthday', 'DESC')->distinct();
    }
}
