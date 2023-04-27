<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Pulisher
 * 
 * @property int $id
 * @property string $name
 * @property boolean|null $condition
 * 
 * @property Collection|Product[] $products
 *
 * @package App\Models
 */
class Pulisher extends Model
{
	protected $table = 'pulisher';
	public $timestamps = false;

	protected $casts = [
		'condition' => 'boolean'
	];

	protected $fillable = [
		'name',
		'condition'
	];

	public function products()
	{
		return $this->hasMany(Product::class, 'id_nxb');
	}
}
