<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * 
 * @property int $id
 * @property string $name
 * @property boolean|null $condition
 * 
 * @property Collection|Product[] $products
 *
 * @package App\Models
 */
class Category extends Model
{
	protected $table = 'categorys';
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
		return $this->hasMany(Product::class, 'id_cat');
	}
}
