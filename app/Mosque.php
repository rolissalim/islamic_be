<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Ramsey\Uuid\Uuid;

class Mosque extends Model
{
    use Notifiable;

    protected $table = 'mosque';
    protected $casts = ['id' => 'string'];
    public $incrementing = false;

    protected $fillable = [
        'id', 'fullname', 'latitude', 'logitude', 'city_id'
    ];
    
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

    public function city() {
        return $this->belongsTo('App\City');
    }

    public function images() {
        return $this->hasMany('App\Imagemosque');
    }

    public function posts() {
        return $this->hasMany('App\Post');
    }  
}
