<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function bookmarksByType($type)
    {
        return $this->bookmarks()->where('bookmarks.model_type', $type);
    }
    public function bookmark($object)
{
	if($this->isBookmarked($object)) {
		return $this->bookmarks()->where([
			['bookmarks.model_type', get_class($object)],
			['bookmarks.model_id', $object->id]
		])->delete();
	}

	return $this->bookmarks()->create(['model_type' => get_class($object), 'model_id' => $object->id]);
}
public function isBookmarked($object)
{
	return $this->bookmarks()->where([
		['bookmarks.model_type', get_class($object)],
		['bookmarks.model_id', $object->id]
	])->exists();
}
}
