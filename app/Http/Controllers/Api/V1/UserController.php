<?php namespace App\Http\Controllers\Api\V1;

/**
 * Class: UserController
 *
 * @see BaseController
 */
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class UserController extends BaseController
{
    use HasApiTokens, Notifiable;

    /**
     * @var string resource_class
     */
    protected $resource_class = 'User';

    /**
     * @var string resource_name
     */
    protected $resource_name  = 'user';

    /**
     * Display the specified resource - inculing relationships
     *
     * @param string $id
     * @return Response
     */


    // public function index()
    // {

    //     $params = Input::all();

    //     // assign resource class to var 
    //     $user = $this->resource_class::query();

    //     /**
    //      * Filters - Name and Specialty
    //      *
    //      */

    //     // if(isset($params['name'])){
    //     //     $doctor = $doctor->where('fname', 'LIKE', '%' . $params['name'] . '%')
    //     //         ->orWhere('lname', 'LIKE', '%' . $params['name'] . '%');
    //     // }

    //     // if(isset($params['specialty_id'])){
    //     //     $doctor = $doctor->whereHas('doctorspecialty', function ($q) use ($params) {
    //     //          $q->where('id', $params['specialty_id']);
    //     //     });
    //     // }
    //     $user = Auth::user();

    //     //switch($user->role_id){

    //         //case 1: 
    //         $user = $user->orderBy('created_at','DESC')
    //             ->with(['role'])
    //             ->paginate();
   
    //         // check if we have a resource
    //         if($user){
    //             // give back the resource that we need
    //             return \Response::json($user, 200);
    //         }
    //     //}
    //      // give them a 404
    //     return $this->response_404();

    // }

    public function show($id = ''){

        $user = Auth::user();


        switch($user->role_id){

            case 1: // Admin

                // $doctor = $this->resource_class::
                //     with(['doctor','doctor.clinic','doctor.doctorspecialty','doctor.doctoravailabilityday'])->find($id);

                $admin = $this->resource_class::with(['admin'])->find($id);
                
                // check if we have a resource
                if ($admin) {
                    
                    // give back the resource that we need
                    return \Response::json($admin, 200);
                }
    
                // give them a 404
                return $this->response_404();

            break;

            case 1: // DOCTOR

                // $doctor = $this->resource_class::
                //     with(['doctor','doctor.clinic','doctor.doctorspecialty','doctor.doctoravailabilityday'])->find($id);

                $doctor = $this->resource_class::
                    with(['doctor'])->find($id);
                
                // check if we have a resource
                if ($doctor) {

                    // give back the resource that we need
                    return \Response::json($doctor, 200);
                }
    
                // give them a 404
                return $this->response_404();

            break;

            case 3: // SECETARY

                // $secretary = $this->resource_class::
                //     with(['secretary','secretary.doctor'])->find($id);

                $secretary = $this->resource_class::
                    with(['secretary'])->find($id);
                
                // check if we have a resource
                if ($secretary) {
                    
                    // give back the resource that we need
                    return \Response::json($secretary, 200);
                }
        
                // give them a 404
                return $this->response_404();

            break;

            case 4: // PHARMACIST
            
                // $pharmacist = $this->resource_class::
                //     with(['pharmacist','pharmacist.pharmacy'])->find($id);

                $pharmacist = $this->resource_class::
                    with(['pharmacist'])->find($id);
        
                // check if we have a resource
                if ($pharmacist) {

                    // log audit trail
                    $this->audit_trail_log('show', $id);
                    
                    // give back the resource that we need
                    return \Response::json($pharmacist, 200);
                }
        
        // give them a 404
        return $this->response_404();

            break;

            case 5: // PATIENT

                // $patient = $this->resource_class::
                //     with(['patient', 'patient.patientcurrentmedication','patient.patientfamilyhistory','patient.patienthealthhistory',
                //         'patient.patientphysicalexam','patient.patientsocialhistory','patient.patientdiagnosis','patient.patientdiagnosis.patientdiagnosisdetail',
                //         'patient.patientprescription', 'patient.patientprescription.hasdoctor', 'patient.patientprescription.prescriptionitems'])->find($id);

                $patient = $this->resource_class::
                    with(['patient'])->find($id);
            
                // check if we have a resource
                if ($patient) {
                    
                    // give back the resource that we need
                    return \Response::json($patient, 200);
                }

                // give them a 404
                return $this->response_404();

            break;

        }

        
        
        // give them a 404
        return $this->response_404();

    }
   

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
    */
    public function store()
    {
        $input = Input::get();
        $input['password'] = \Hash::make($input['password']);
        
        $user = $this->resource_class::create($input);

        return \Response::json($user, 200);
    }

}