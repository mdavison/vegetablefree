<?php namespace App;

use App\Http\Requests\UpdateUserRequest;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword, SoftDeletes;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['username', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

    /**
     * Enable soft deletes
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Validation rules
     * @var array
     */
    public static $rules = [
        'username' => 'required|max:255|unique:users',
        'email' => 'required|email|max:255|unique:users,email',
        'password' => 'required|confirmed|min:12|max:255',
    ];


    /**
     * Define user to recipe relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recipes()
    {
        return $this->hasMany('\App\Recipe');
    }

    public function getUniqueUsernameSlug($username)
    {
        $slug = str_slug($username);
        $count = $this::whereRaw("username_slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }

    public function createUser(Request $request)
    {
        $this->username = $request->get('username');
        $this->username_slug = $this->getUniqueUsernameSlug($request->get('username'));
        $this->email = $request->get('email');
        $this->password = bcrypt($request->get('password'));
        $this->save();

        return $this;
    }

    public function updateUser(UpdateUserRequest $request)
    {
        // If username has changed, update username_slug
        if ($this->username !== $request->get('username')) {
            $this->username_slug = $this->getUniqueUsernameSlug($request->get('username'));
        }

        // Only change the password if they entered something
        $password = $request->get('password');
        if ( ! empty($password)) {
            $this->password = bcrypt($password);
        }

        $this->username = $request->get('username');
        $this->email = $request->get('email');

        $this->update();

        return $this;
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function($user){
            $user->verification_token = str_random(30);
        });
    }

    public function confirmEmail()
    {
        $this->is_verified = true;
        $this->verification_token = null;

        $this->save();
    }

}
