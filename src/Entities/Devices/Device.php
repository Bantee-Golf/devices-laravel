<?php


namespace EMedia\Devices\Entities\Devices;


use Carbon\Carbon;
use EMedia\Helpers\Database\CreatesUniqueTokens;
use EMedia\QuickData\Entities\Search\SearchableTrait;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{

	use CreatesUniqueTokens;
	use SearchableTrait;

	protected $defaultTokenExpiryDays = 90;

	protected $fillable = [
		'device_id',
		'device_type',
		'device_push_token',
		'user_id',
	];

	protected $searchable = [
		'device_id',
		'device_push_token',
	];

	protected $dates = [
		'access_token_expires_at',
	];

	public function getShowable()
	{
		return [
			'device_id',
			'device_type',
			'device_push_token',
			'user_id',
			'access_token',
		];
	}

	public function scopeActive($query)
	{
		return $query->where(function ($q) {
			$q->whereNull('access_token_expires_at');
			$q->orWhere('access_token_expires_at', '>', Carbon::now());
		});
	}

	public function user()
	{
		return $this->belongsTo('\App\User');
	}

	/**
	 *
	 * Force device type to be lower-case
	 *
	 * @param $value
	 */
	public function setDeviceTypeAttribute($value)
	{
		$this->attributes['device_type'] = strtolower($value);
	}

	/**
	 *
	 * Reset device access token
	 *
	 */
	public function resetAccessToken()
	{
		$this->attributes['access_token'] = null;
		$this->attributes['access_token_expires_at'] = null;
		$this->save();
	}

	/**
	 *  Setup model event hooks
	 */
	public static function boot()
	{
		parent::boot();
		self::creating(function ($model) {
			$model->access_token = self::newUniqueToken('access_token');
			$model->access_token_expires_at = Carbon::now()->addDays($this->getDefaultTokenExpiryDays());
		});
	}

	/**
	 * @return int
	 */
	public function getDefaultTokenExpiryDays(): int
	{
		return $this->defaultTokenExpiryDays;
	}

	/**
	 * @param int $defaultTokenExpiryDays
	 */
	public function setDefaultTokenExpiryDays(int $defaultTokenExpiryDays)
	{
		$this->defaultTokenExpiryDays = $defaultTokenExpiryDays;

		return $this;
	}

}