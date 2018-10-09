<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ExchangeRate extends Model
{
    /**
     * Immutable values.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * This model relationship belongs to \App\Models\Submission.
     *
     * @return  \Illuminate\Database\Eloquent\Model
     */
    public function submission()
    {
        return $this->belongsTo('App\Submission', 'submission_id');
    }

    /**
     * Returns a hong kong dollar to 4 decimal places.
     *
     * @return string
     */
    public function getHongKongDollarAttribute()
    {
        return number_format($this->attributes['hong_kong_dollar'], 4);
    }

    /**
     * Returns a formatted hong kong dollar value.
     *
     * @return string
     */
    public function getFormattedHongKongDollarAttribute()
    {
        return  $this->attributes['hong_kong_dollar'] . " HKD";
    }
}
