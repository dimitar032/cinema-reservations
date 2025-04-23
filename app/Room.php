<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name',
    ];

    public function isFreeForProjection($start)
    {
        foreach ($this->projections->load('movie') as $projection) {
            $endOfMovie = $projection->start
                ->addMinutes($projection->movie->duration)
                ->addMinutes(Projection::BREAK_BETWEEN_PROJECTIONS_IN_MINUTES);

            $requestedTime = Carbon::createFromFormat('Y-m-d H:i:s', $start);
            if ($requestedTime->between($projection->start, $endOfMovie)) {
                return false;
            }
        }

        return true;
    }



    public function seats()
    {
        return $this->hasMany(Seat::class);
    }

    public function projections()
    {
        return $this->hasMany(Projection::class);
    }
}
