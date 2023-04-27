<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * 
 * @property int $id
 * @property string $name
 * @property int $quantity
 * @property string|null $price
 * @property int $id_nxb
 * @property int $id_cat
 * @property boolean|null $condition
 * 
 * @property Category $category
 * @property Pulisher $pulisher
 * @property Collection|DetailProduct[] $detail_products
 * @property Collection|Image[] $images
 *
 * @package App\Models
 */
class Product extends Model
{
	protected $table = 'products';
	public $timestamps = false;

	protected $casts = [
		'quantity' => 'int',
		'id_nxb' => 'int',
		'id_cat' => 'int',
		'condition' => 'boolean'
	];

	protected $fillable = [
		'name',
		'quantity',
		'price',
		'id_nxb',
		'id_cat',
		'condition'
	];

	public function category()
	{
		return $this->belongsTo(Category::class, 'id_cat');
	}

	public function pulisher()
	{
		return $this->belongsTo(Pulisher::class, 'id_nxb');
	}

	public function detail_products()
	{
		return $this->hasMany(DetailProduct::class, 'id_prd');
	}

	public function images()
	{
		return $this->hasMany(Image::class, 'id_prd');
	}
}
