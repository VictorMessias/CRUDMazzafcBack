<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{

    protected $table = 'agenda';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'patient_id', 'doctor_id', 'date'
    ];


    public function patient(){
        return $this->belongsTo('App\Patient', 'patient_id');
    }

    public function doctor(){
        return $this->belongsTo('App\Doctor', 'doctor_id');
    }


}
