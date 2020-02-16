<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Ramsey\Uuid\Uuid;

class Role extends Model {

    use Notifiable;

    protected $table = 'role_user';
    protected $casts = ['id' => 'string'];
    public $incrementing = false;
    protected $fillable = [
        'id', 'fullname','description'
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

    public function posts() {
        return $this->hasMany('App\Post');
    }

    public function user() {
        return $this->hasMany(User::class);
    }

}
