<?php

namespace App;

use App\Movie;
use App\Reservation;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Building extends Model
{
    protected $fillable = [
        'name',
        'longitude',
        'latitude',
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
    public function city(){
        return $this->belongsTo(City::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function movies()
    {
        return $this->belongsToMany(Movie::class,'building_movie');
    }

    public function getProjectionsForTodayJson()
    {
        $data = collect(DB::select('
          SELECT
            b.name as building_name,
            p.id AS projection_id,
            HOUR(start) AS start_hour,
            DATE_FORMAT(start, \'%H:%i\') as start_time,
            m.name AS movie_name,
            m.id AS movie_id,
              CONCAT_WS(\'\',\'/storage/movie_posters/\',poster) as movie_poster_url,
            p.room_id AS room_id
          FROM projections p
            JOIN movies m ON p.movie_id = m.id
            JOIN rooms r ON p.room_id = r.id
            JOIN buildings b ON r.building_id = b.id
          WHERE
            r.building_id = :building_id AND
            DATE(start) = CURDATE() AND 
            HOUR(start) >= :current_hour_minus_one
        ', [
            'building_id' => $this->id,
            'current_hour_minus_one' => 0,
            // 'current_hour_minus_one' => date('H'),
          ]));

        return $data->groupBy('start_hour');
    }

    public function findReservationWithParam($searchParam)
    {
        return DB::select('
          SELECT
            u.id as user_id,
            u.name as user_name,
            u.email as user_email,

            pro.id as projection_id,
            DATE_FORMAT(pro.start, \'%H:%i\') AS projection_start_time,

            mo.name as movie_name,
            COUNT(1) as count_reserved_seats
          FROM projections pro
            JOIN rooms ro ON pro.room_id = ro.id
            JOIN reservations res ON pro.id = res.projection_id
            JOIN users u ON res.user_id = u.id
            join movies mo on pro.movie_id = mo.id
          WHERE
            ro.building_id = ? AND
            (
              u.name LIKE \'%'.$searchParam.'%\' OR
              u.email LIKE \'%'.$searchParam.'%\'
            )
          GROUP BY pro.id;
        ', [$this->id]);
    }
        

    //todo test me
    public function getLastDaysReservationStatusCounts()
    {
        return DB::select('
            SELECT
              selected_date,
              IFNULL(count_of_all_reservations_per_day, 0) as count_of_all_reservations_per_day,
              IFNULL(count_of_all_used_reservations_per_day, 0) as count_of_all_used_reservations_per_day
            FROM
              (
               SELECT adddate(\'1970-01-01\', t4.i * 10000 + t3.i * 1000 + t2.i * 100 + t1.i * 10 + t0.i) selected_date
                FROM
                  (SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t0,
                  (SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t1,
                  (SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t2,
                  (SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t3,
                  (SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t4)
              v
              LEFT JOIN (
                  SELECT
                    COUNT(1)   AS count_of_all_reservations_per_day,
                    COUNT(CASE WHEN res.reservation_type_id = 2 THEN 1 END)   AS count_of_all_used_reservations_per_day,
                    DATE(pro.start) AS reservation_date
                  FROM reservations res
                    JOIN projections pro ON res.projection_id = pro.id
                    JOIN rooms ro ON pro.room_id = ro.id
                  WHERE ro.building_id = :building_id
                  GROUP BY DATE(pro.start)
              ) b ON b.reservation_date = selected_date
            WHERE selected_date BETWEEN SUBDATE(CURDATE(), INTERVAL 30 DAY) AND ADDDATE(CURDATE(), INTERVAL 1 DAY)
        ' ,['building_id' => $this->id]);

    }
            
    //todo test me
    public function reservations()
    {
        return Reservation::hydrate(
            DB::select('
                SELECT res.*
                FROM reservations res
                    JOIN seats s ON res.seat_id = s.id
                    JOIN rooms ro ON s.room_id = ro.id
                WHERE ro.building_id = ?
                ', [$this->id])
        );
    }
            

    public function getAvailableProjectionForMovie(Movie $movie){
        $projections = collect(DB::select('
            SELECT
              p.id                              AS projection_id,
              TIME_FORMAT(p.start, \'%H:%i\')   AS projection_start_time,
              DATE_FORMAT(p.start, \'%d.%m\') AS projection_date
            FROM projections p
              JOIN rooms r ON p.room_id = r.id
            WHERE
              r.building_id = ? AND
              p.movie_id = ? AND
              p.start BETWEEN DATE_ADD(UTC_TIMESTAMP, INTERVAL -30 MINUTE) AND DATE_ADD(UTC_TIMESTAMP, INTERVAL 7 DAY)
            ORDER BY p.start
        ', [$this->id,$movie->id]))->groupBy('projection_date')->toArray();
        $days=[];
        for ($i=0; $i <= 7; $i++) { 
            $days[Carbon::now()->addDay($i)->format('d.m')] = [];
        }    
        $result = array_merge_recursive($projections,$days);
        ksort($result);
        return $result;
    }

    public function getBuildingMovieReservations()
    {
        return DB::select('
            SELECT
              m.name as movie_name,
              COUNT(1) AS reservation_per_movie
            FROM reservations res
              JOIN projections pro ON res.projection_id = pro.id
              JOIN rooms ro ON pro.room_id = ro.id
              JOIN movies m ON pro.movie_id = m.id
            WHERE
              ro.building_id = :building_id AND
              DATE(pro.start) BETWEEN SUBDATE(CURDATE(), INTERVAL 30 DAY) AND ADDDATE(CURDATE(), INTERVAL 1 DAY)
            GROUP BY movie_id
            ORDER BY reservation_per_movie DESC
        ', ['building_id' => $this->id]);
    }
            
    public function employees()
    {
      return $this->belongsToMany(User::class, 'building_user', 'building_id');
    }
        

    public function projections()
    {
        return $this->hasManyThrough(Projection::class, Room::class);
    }

    public static function rules()
    {
        return [
            'name' => 'required|min:2|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ];
    }
}
