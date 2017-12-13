<?php namespace App\Http\Controllers\Api\V1;

/**
 * Class: AdminController
 *
 * @see BaseController
 */

use Illuminate\Support\Facades\Input;

class AdminController
    extends BaseController
{
    
     /**
     * @var string resource_class
     */
    protected $resource_class= 'Admin';

    /**
     * @var string resource_name
     */
    protected $resource_name  = 'admin';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $params = Input::all();

        // assign resource class to var 
        $admin = $this->resource_class::query();

        /**
         * Filters - Name and Specialty
         *
         */

        // if(isset($params['name'])){
        //     $doctor = $doctor->where('fname', 'LIKE', '%' . $params['name'] . '%')
        //         ->orWhere('lname', 'LIKE', '%' . $params['name'] . '%');
        // }

        // if(isset($params['specialty_id'])){
        //     $doctor = $doctor->whereHas('doctorspecialty', function ($q) use ($params) {
        //          $q->where('id', $params['specialty_id']);
        //     });
        // }

        $admin = $admin->orderBy('created_at','DESC')
                ->with(['role','user'])
                ->paginate();
   
        // check if we have a resource
        if($admin){
            // give back the resource that we need
            return \Response::json($admin, 200);
        }
         // give them a 404
        return $this->response_404();

    }

    /**
     * Display the specified resource - inculing relationships
     *
     * @param string $id
     * @return Response
     */

    public function show($id = ''){

        $doctor = $this->resource_class::
            with(['role','user'])->find($id);
        
        // check if we have a resource
        if ($doctor) {

            // log audit trail
           // $this->audit_trail_log('show', $id);
            
            // give back the resource that we need
            return \Response::json($doctor, 200);
        }
        
        // give them a 404
        return $this->response_404();
    }

}