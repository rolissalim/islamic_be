<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Ramsey\Uuid\Uuid;
use App\Resource_person;

class Post extends Model {

    use Notifiable;

    protected $table = 'post';
    protected $casts = ['id' => 'string'];
    public $incrementing = false;
    protected $fillable = [
        'id', 'text', 'mosque_id', 'category_id', 'path', 'post_time', 'periodic',
        'user_id', 'resource_person_id', 'theme'
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

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function resource_person() {
        return $this->belongsTo('App\Resource_person');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function mosque() {
        return $this->belongsTo('App\Mosque');
    }

    public function image_mosque() {
        return $this->hasMany('App\Imagemosque', 'mosque_id');
    }

}
