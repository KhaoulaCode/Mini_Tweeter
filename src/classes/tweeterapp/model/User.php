<?php
namespace iutnc\tweeterapp\model;

class User extends \Illuminate\Database\Eloquent\Model {

    protected $table      = 'user';
    protected $primaryKey = 'id';
    public    $timestamps = false;

    public function tweets(){
        return $this->hasMany(Tweet::class, 'author');
    }

    public function liked(){
        return $this->belongsToMany(Tweet::class, 'like', 'user_id', 'tweet_id');
    }
    
    public function followedBy(){
        return $this->belongsToMany(User::class, 'follow', 'followee', 'follower');
    }
    
    public function follows(){
        return $this->belongsToMany(User::class, 'follow', 'follower', 'followee');
    }
}