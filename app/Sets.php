<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Movies;


class Sets extends Model
{
    protected $table = 'sets';

    protected $fillable =['title', 'image', 'description', 'status', 'created_at', 'updated_at'];

    protected $primaryKey='id';

    //relation between sets and movies
    public function movies()
    {
        return $this->hasMany('App\Movies','set_id');
    }

    // function to delete all related movies when deleting a set
    protected static function boot() {
        parent::boot();
        static::deleting(function($set) { // before delete() method call this
            $set->movies()->delete(); // deletes all related movies
        });
    }


}
