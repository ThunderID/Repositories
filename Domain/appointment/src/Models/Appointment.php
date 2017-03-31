<?php

namespace Thunderlabid\Appointment\Models;

use Thunderlabid\Appointment\Models\Traits\Policies\TanggalTrait;

use Validator, Exception;

/**
 * Model Appointment
 *
 * Digunakan untuk menyimpan data Appointment.
 *
 * @package    Thunderlabid
 * @subpackage Appointment
 * @author     C Mooy <chelsy@thunderlab.id>
 */
class Appointment extends BaseModel
{
	use TanggalTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table				= 'appointment';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable				=	[
											'id'				,
											'atas_nama'			,
											'waktu_pertemuan'	,
											'tempat_bertemu'	,
											'agenda'			,
										];
	/**
	 * Basic rule of database
	 *
	 * @var array
	 */
	protected $rules				=	[
											'atas_nama'			=> 'required|max:255',
											'waktu_pertemuan'	=> 'date_format:"Y-m-d H:i:s"',
											'tempat_bertemu'	=> 'required|max:255',
											'agenda'			=> 'required',
										];
	/**
	 * Date will be returned as carbon
	 *
	 * @var array
	 */
	protected $dates				= ['created_at', 'updated_at', 'deleted_at', 'waktu_pertemuan'];
	
	/**
	 * Date will be returned as carbon
	 *
	 * @var array
	 */
	protected $appends				= [];

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
	public function AppointmentWith()
	{
		return $this->hasMany('\Thunderlabid\Appointment\Models\AppointmentWith', 'appointment_id');
	}

	/* ---------------------------------------------------------------------------- QUERY BUILDER ----------------------------------------------------------------------------*/
	
	/* ---------------------------------------------------------------------------- MUTATOR ----------------------------------------------------------------------------*/
	protected function setWaktuPertemuanAttribute($value)
	{
		$this->attributes['waktu_pertemuan']	= $this->formatDateTimeFrom($value);
	}

	/* ---------------------------------------------------------------------------- ACCESSOR ----------------------------------------------------------------------------*/
	protected function getWaktuPertemuanAttribute()
	{
		return $this->formatDateTimeTo($this->attributes['waktu_pertemuan']);
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

	public function addAppointmentWith(array $data)
	{
		$appointee 	= new AppointmentWith;
		$appointee->fill($data);
		$appointee->appointment_id 	= $this->id;

		$appointee->save();

		return $this;
	}

	public function addReminder(array $data)
	{
		$reminder 		= new Reminder;
		$reminder->fill($data);
		$reminder->appointment_id 	= $this->id;

		$reminder->save();

		return $this;
	}

	/* ---------------------------------------------------------------------------- SCOPES ----------------------------------------------------------------------------*/
}
