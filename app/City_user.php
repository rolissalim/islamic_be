<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Ramsey\Uuid\Uuid;

class City_user extends Model
{
    use Notifiable;

    protected $table = 'city_user';
    protected $casts = ['id' => 'string'];
    public $incrementing = false;
    protected $fillable = [
        'id', 'city_id', 'user_id'
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
}
