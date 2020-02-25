<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Validator;

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

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public static function getPostErrors($request)
    {
        $validator = Validator::make($request->all(), [
            'birthday' => 'required|date',
        ]);
        /**
         * Store validator errors
         *
         * @var array
         */
        $errors = $validator->errors()->all();

        if(empty($errors))
        {
            /**
             * Sanitize birthday input.
             *
             * @var string
             */
            $birthday = filter_var($request->input('birthday'), FILTER_SANITIZE_STRING);
            /**
             * Check if birthday occurred in the last year
             */
            $now = Carbon::now();
            $oneYearAgo = Carbon::now()->subDays(365);
            $birthday = Carbon::parse($birthday);

            if($birthday->between($now, $oneYearAgo) == FALSE)
            {
                array_push($errors, 'Select your birthday within the last year.');
            }
        }

        return $errors;
    }
}
