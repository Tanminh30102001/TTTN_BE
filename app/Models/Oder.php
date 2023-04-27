<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Oder
 * 
 * @property int $id
 * @property Carbon|null $date
 * @property int $condition
 * @property int $id_us
 * 
 * @property User $user
 * @property Collection|DetailsOder[] $details_oders
 *
 * @package App\Models
 */
class Oder extends Model
{
	protected $table = 'oders';
	public $timestamps = false;

	protected $casts = [
		'date' => 'datetime',
		'condition' => 'int',
		'id_us' => 'int'
	];

	protected $fillable = [
		'date',
		'condition',
		'id_us'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'id_us');
	}

	public function details_oders()
	{
		return $this->hasMany(DetailsOder::class, 'id_oders');
	}
}
