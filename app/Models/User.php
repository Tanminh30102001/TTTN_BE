<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 *
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $address
 * @property int $id
 * @property boolean|null $condition
 *
 * @property Collection|Oder[] $oders
 * @property Collection|SessionUser[] $session_users
 *
 * @package App\Models
 */
class User extends \Illuminate\Foundation\Auth\User
{
    use HasApiTokens, HasFactory, Notifiable;

	protected $table = 'users';

	protected $casts = [
		'email_verified_at' => 'datetime',
		'condition' => 'boolean'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'email',
		'email_verified_at',
		'password',
		'remember_token',
		'address',
		'condition'
	];

	public function oders()
	{
		return $this->hasMany(Oder::class, 'id_us');
	}

	public function session_users()
	{
		return $this->hasMany(SessionUser::class, 'id_us');
	}
}
