<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Ramsey\Uuid\Uuid;

class City extends Model {

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'city';
    protected $casts = ['id' => 'string'];
    public $incrementing = false;
    protected $fillable = [
        'id', 'country_id', 'fullname', 'latitude', 'logitude'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    protected static function boot() {
        parent::boot();

        static::creating(function ($model) {
            try {
                $model->id = Uuid::uuid4()->getHex();
            } catch (UnsatisfiedDependencyException $e) {
                abort(500, $e->getMessage());
            }
        });
    }

    public function country() {
        return $this->belongsTo('App\Country');
    }

    public function mosques() {
        return $this->hasMany('App\Mosque');
    }

    public function user() {
        return $this->belongsToMany(User::class);
    }

}
