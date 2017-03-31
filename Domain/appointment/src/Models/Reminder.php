<?php

namespace Thunderlabid\Appointment\Models;

use Thunderlabid\Appointment\Models\Traits\Policies\TanggalTrait;

/**
 * Model Reminder
 *
 * Digunakan untuk menyimpan data Reminder.
 * Ketentuan : 
 *
 * @package    Thunderlabid
 * @subpackage Appointment
 * @author     C Mooy <chelsy@thunderlab.id>
 */
class Reminder extends BaseModel
{
	use TanggalTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table				= 'reminder';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable				=	[
											'id'					,
											'appointment_id'		,
											'waktu'					,
										];

	/**
	 * Basic rule of database
	 *
	 * @var array
	 */
	protected $rules				=	[
											'appointment_id'		=> 'max:255',
											'waktu'					=> 'date_format:"Y-m-d H:i:s"',
										];
	/**
	 * Date will be returned as carbon
	 *
	 * @var array
	 */
	protected $dates				= ['created_at', 'updated_at', 'deleted_at'];
	
	/**
	 * hidden data
	 *
	 * @var array
	 */
	protected $hidden				= 	[
											'created_at', 
											'updated_at', 
											'deleted_at', 
										];

	/* ---------------------------------------------------------------------------- RELATIONSHIP ----------------------------------------------------------------------------*/

	/* ---------------------------------------------------------------------------- QUERY BUILDER ----------------------------------------------------------------------------*/
	
	/* ---------------------------------------------------------------------------- MUTATOR ----------------------------------------------------------------------------*/
	protected function setWaktuAttribute($value)
	{
		$this->attributes['waktu']	= $this->formatDateTimeFrom($value);
	}

	/* ---------------------------------------------------------------------------- ACCESSOR ----------------------------------------------------------------------------*/
	protected function getWaktuAttribute()
	{
		return $this->formatDateTimeTo($this->attributes['waktu']);
	}

	/* ---------------------------------------------------------------------------- FUNCTIONS ----------------------------------------------------------------------------*/

	/**
	 * boot
	 * observing model
	 *
	 */	
	public static function boot() 
	{
		parent::boot();
	}

	/* ---------------------------------------------------------------------------- SCOPES ----------------------------------------------------------------------------*/
}
