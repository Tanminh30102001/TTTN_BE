<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SessionUser
 * 
 * @property int $id
 * @property string $token
 * @property Carbon $token_expried
 * @property string|null $refresh_token
 * @property Carbon|null $refresh_token_expried
 * @property int|null $id_us
 * 
 * @property User|null $user
 *
 * @package App\Models
 */
class SessionUser extends Model
{
	protected $table = 'session_users';
	public $timestamps = false;

	protected $casts = [
		'token_expried' => 'datetime',
		'refresh_token_expried' => 'datetime',
		'id_us' => 'int'
	];

	protected $hidden = [
		'token',
		'refresh_token'
	];

	protected $fillable = [
		'token',
		'token_expried',
		'refresh_token',
		'refresh_token_expried',
		'id_us'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'id_us');
	}
}
