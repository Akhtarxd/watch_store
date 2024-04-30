<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Comment;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    const ADMIN_ROLE = 1;
    const USER_ROLE = 0;
    const USER_ACTIVE = 1;
    const USER_DEACTIVE = 0;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fname',
        'lname',
        'email',
        'password',
        'address',
        'contact',
        'gender',
        'country',
        'profile',
        'role_id',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getFullNameAttribute(){
        return ucfirst($this->fname).' '.ucfirst($this->lname);
    }

    public function getRoleNameAttribute(){
        return ($this->role_id ==  self::ADMIN_ROLE ? 'Admin': 'User');
    }

    public function countryData(){
        return $this->hasOne(Country::class,'id','country');
    }
    public function commentData(){
        return $this->hasOne(Comment::class);
    }
}
