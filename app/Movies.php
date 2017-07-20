<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movies extends Model
{
    protected $table = 'movies';

    protected $primaryKey='id';

    protected $fillable =['set_id', 'title', 'image', 'description', 'created_date', 'status', 'created_at', 'updated_at'];

    public function set()
    {
        return $this->belongsTo('App\sets','set_id');
    }

}
