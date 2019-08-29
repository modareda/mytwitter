<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function following()
    {
        return $this->belongsToMany('App\User', 'friends_users', 'user_id', 'friend_id');
    }

    public function followers()
    {
        return DB::table('friends_users')->where('friend_id', '=', $this->id)->get();
    }

    public function isFriend(User $user)
    {
        return in_array($user->id, $this->following()->pluck('friend_id')->toArray());
    }

    public function follow(User $user)
    {
        if(!$this->isFriend($user))
        {
            $this->following()->attach($user->id);
        }
    }
    public function unFollow(User $user)
	{
        if($this->isFriend($user))
        {
            $this->following()->detach($user->id);
        }
    }
    
    // public function iLikeThisPost(Post $post)
    // {
    //     return !!(like::where('post_id', $post->id)->where('user_id', $this->id)->first());
    // }

    public function getMessages(User $user)
    {
        return Message::where('user_id', $this->id)
                        ->where('reciver_id', $user->id)
                        ->orWhere('user_id', $user->id)
                        ->where('reciver_id', $this->id);
    }
}
