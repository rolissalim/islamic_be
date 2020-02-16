<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Ramsey\Uuid\Uuid;

class Category extends Model {

    use Notifiable;

    protected $table = 'category';
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

}
