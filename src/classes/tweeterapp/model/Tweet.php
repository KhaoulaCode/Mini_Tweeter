<?php
namespace iutnc\tweeterapp\model;

class Tweet extends \Illuminate\Database\Eloquent\Model {

    protected $table      = 'tweet';
    protected $primaryKey = 'id';
    public    $timestamps = true;
    
    public function author(){
        return $this->belongsTo(User::class, 'author');
    }

    public function likedBy() {
        return $this->belongsToMany(User::class, 'like', 'tweet_id', 'user_id');
    }
}