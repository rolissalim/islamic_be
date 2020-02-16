<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Ramsey\Uuid\Uuid;
use App\Post;

class Resource_person extends Model {

    use Notifiable;

    protected $table = 'resource_person';
    protected $casts = ['id' => 'string'];
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'fullname', 'alamat', 'phonenumber', 'education_degree', 'image', 'city_id'
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

    public function post() {
        return $this->hasOne('App\Post');
    }
    

}
