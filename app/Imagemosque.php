<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Ramsey\Uuid\Uuid;

class Imagemosque extends Model {

    use Notifiable;

    protected $table = 'image_mosque';
    protected $casts = ['id' => 'string'];
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'fullname', 'latitude', 'logitude', 'city_id', 'path'
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

    public function city() {
        return $this->belongsTo('App\City');
    }

    public function mosque() {
        return $this->belongsTo('App\Mosque');
    }

    public function post() {
        return $this->belongsTo('App\post', 'mosque_id');
    }

}
