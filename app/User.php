<?php

namespace App;

use App\Reservation;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //created buildings
    public function buildings()
    {
        return $this->hasMany(Building::class)->orderBy('name');
    }

    public function employee_buildings()
    {
      return $this->belongsToMany(Building::class, 'building_user', 'user_id');
    }
    

    //todo test me
    public function setFavoriteBuilding()
    {
        $result = DB::select('
            SELECT
              SUM(1) as reservation_count,
              building_id as favorite_building_id
            FROM reservations res
              join projections p ON res.projection_id = p.id
              join rooms ro ON p.room_id = ro.id
            where user_id = :user_id
            GROUP BY ro.building_id
            ORDER BY reservation_count DESC
            LIMIT 1
        ', ['user_id' => auth()->id()]);

        // if(isset($result[0]) && $result->favorite_building_id){
            // $this->favorite_building_id = $result->favorite_building_id;
            // $this->save();    
        // }
        
    }
            

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

}
