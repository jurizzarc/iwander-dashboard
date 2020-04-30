<?php
# @Author: maerielbenedicto
# @Date:   2019-08-27T22:26:48+01:00
# @Last modified by:   maerielbenedicto
# @Last modified time: 2019-10-22T00:51:26+01:00




namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles() {
      return $this->belongsToMany('App\Role','user_role');
    }

    public function authorizeRoles($roles) {
      if(is_array($roles)){
        return $this->hasAnyRoles($roles) || abort(401,'This action is unathorized.');
      }
      return $this->hasRole($roles) || abort(401,'This action is unathorized.');
    }

    public function hasRole($role) {
      return null != $this->roles()->where('name',$role)->first();
    }

    //In -> looks for element in a list
    public function hasAnyRole($roles) {
      return null != $this->roles()->whereIn('name',$roles)->first();
    }

    public function bookmark() {
      return $this->hasMany('App\Bookmark');
    }

    public function itineraries() {
      return $this->hasMany('App\Itinerary');
    }
}
