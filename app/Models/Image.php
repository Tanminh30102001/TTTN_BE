<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Image
 * 
 * @property int $id
 * @property string $images
 * @property int $id_prd
 * @property boolean|null $condition
 * 
 * @property Product $product
 *
 * @package App\Models
 */
class Image extends Model
{
	protected $table = 'images';
	public $timestamps = false;

	protected $casts = [
		'id_prd' => 'int',
		'condition' => 'boolean'
	];

	protected $fillable = [
		'images',
		'id_prd',
		'condition'
	];

	public function product()
	{
		return $this->belongsTo(Product::class, 'id_prd');
	}
}
