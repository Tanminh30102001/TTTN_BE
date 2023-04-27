<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DetailsOder
 * 
 * @property int $id
 * @property int $quantity
 * @property boolean|null $condition
 * @property string|null $payment
 * @property string|null $delivery
 * @property int $id_oders
 * 
 * @property Oder $oder
 *
 * @package App\Models
 */
class DetailsOder extends Model
{
	protected $table = 'details_oders';
	public $timestamps = false;

	protected $casts = [
		'quantity' => 'int',
		'condition' => 'boolean',
		'id_oders' => 'int'
	];

	protected $fillable = [
		'quantity',
		'condition',
		'payment',
		'delivery',
		'id_oders'
	];

	public function oder()
	{
		return $this->belongsTo(Oder::class, 'id_oders');
	}
}
