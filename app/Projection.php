<?php

namespace App;

use App\Reservation;
use App\Room;
use App\User;
use App\Seat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Projection extends Model
{
    const BREAK_BETWEEN_PROJECTIONS_IN_MINUTES = 15;

    protected $fillable = [
        'name',
        'start',
        'movie_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'start'
    ];
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function reserved_seats()
    {
        return $this->belongsTo(Seat::class);
    }


    public static function rules()
    {
        return [
            'start' => 'required|date',
            'movie_id' => 'required|exists:movies,id',
        ];
    }

    //todo make this better
    //todo add test to this
    public function getAllSeat(){
        $data['all_seats'] = collect(
            DB::select('
                SELECT
                  reserved_seats.reservation_type_id,
                  s.*
                FROM seats s
                  JOIN rooms r1 ON s.room_id = r1.id
                  LEFT JOIN (
                              SELECT
                                ss.id as seat_id,
                                res.reservation_type_id
                              FROM seats ss
                                JOIN rooms r ON ss.room_id = r.id
                                JOIN reservations res ON res.seat_id = ss.id
                                JOIN projections p ON res.projection_id = p.id
                              WHERE p.id = :projection_id
                            ) reserved_seats ON reserved_seats.seat_id = s.id
                WHERE r1.id = :room_id
                ',[
                    'projection_id' => $this->id,
                    'room_id' => $this->room->id,
                ])
        )->groupBy('row');

        $data['projection']['id']=$this->id;
        $data['projection']['formatted_date']=$this->start->format('m.d');
        $data['projection']['formatted_hour']=$this->start->format('H:i');
        return $data;

    }

    public function makeDirectSellReservation(array $desirableSeats)
    {
        $this->makeReservation($desirableSeats,Reservation::DIRECT_SELL);
    }

    public function getUserReservedSeats(User $user){
        return collect(DB::select('
            SELECT
              reserved_seats.reservation_type_id,
              s.*,
              user_reserved_seats.user_reserved
            FROM seats s
              JOIN rooms r1 ON s.room_id = r1.id
              LEFT JOIN (
                    SELECT 
                      s.id as seat_id,
                      1 as user_reserved
                    from reservations r 
                        join seats s ON r.seat_id = s.id
                    where 
                        r.user_id = :user_id and 
                        r.reservation_type_id = 1 and
                        r.projection_id = :projection_id
              ) user_reserved_seats ON user_reserved_seats.seat_id = s.id

              LEFT JOIN (
                          SELECT
                            ss.id as seat_id,
                            res.reservation_type_id
                          FROM seats ss
                            JOIN rooms r ON ss.room_id = r.id
                            JOIN reservations res ON res.seat_id = ss.id
                            JOIN projections p ON res.projection_id = p.id
                          WHERE p.id = :pprojection_id
                        ) reserved_seats ON reserved_seats.seat_id = s.id
            WHERE r1.id = :room_id
        ', [
            'user_id' => $user->id,
            'projection_id' => $this->id,
            'pprojection_id' => $this->id,
            'room_id' => $this->room->id,
        ]))->groupBy('row');

    }

    public function makeNewReservationForNormalUser(array $desirableSeats)
    {
        $this->makeReservation($desirableSeats,Reservation::NEW_TYPE);
    }

    //todo make repository perhaps..
    private function makeReservation(array $desirableSeats,int $reservationType)
    {
        if(count($desirableSeats) > Reservation::MAX_SEATS_PER_USER_FOR_RESERVATION){
            throw new \Exception(
                Reservation::MAX_SEATS_PER_USER_FOR_RESERVATION.' are max allowed seats per reservation.',
                1337
            );
        }

        //todo add validation if seat is already taken
        //todo add validation if user has reservation in this TIME

        foreach($desirableSeats as $seatId){
            $reservation = new Reservation;
            $reservation->reservation_type_id = $reservationType;
            $reservation->user_id = auth()->id();
            $reservation->projection_id = $this->id;
            $reservation->seat_id = $seatId;
            $reservation->save();
        }
    }

}
