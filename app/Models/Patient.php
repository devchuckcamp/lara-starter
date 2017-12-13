<?php

/**
 * Class: Patient
 *
 * @see BaseModel
 */

class Patient extends BaseModel
{
    
    /**
     *
     * @var define relationships
     */

    public function patientdiagnosis()
    {
        return $this->hasMany('PatientDiagnosis','patient_id','id');
    }

    public function patientprescription()
    {
        return $this->hasMany('Prescription','patient_id','id');
    }
    
	public function patientcurrentmedication()
    {
        return $this->hasOne('PatientCurrentMedication','patient_id','id');
    }

    public function patientfamilyhistory()
    {
        return $this->hasOne('PatientFamilyHistory','patient_id','id');
    }

    public function patienthealthhistory()
    {
        return $this->hasOne('PatientHealthHistory','patient_id','id');
    }

    public function patientphysicalexam()
    {
        return $this->hasOne('PatientPhysicalExam','patient_id','id');
    }

    public function patientsocialhistory()
    {
        return $this->hasOne('PatientSocialHistory','patient_id','id');
    }

    public function user()
    {
        return $this->belongsTo('User','user_id','id');
    }


    
}
