<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DetailProduct
 * 
 * @property int $id
 * @property string $des
 * @property Carbon $date
 * @property string $author
 * @property int $id_prd
 * @property boolean|null $condition
 * 
 * @property Product $product
 *
 * @package App\Models
 */
class DetailProduct extends Model
{
	protected $table = 'detail_product';
	public $timestamps = false;

	protected $casts = [
		'date' => 'datetime',
		'id_prd' => 'int',
		'condition' => 'boolean'
	];

	protected $fillable = [
		'des',
		'date',
		'author',
		'id_prd',
		'condition'
	];

	public function product()
	{
		return $this->belongsTo(Product::class, 'id_prd');
	}
}
