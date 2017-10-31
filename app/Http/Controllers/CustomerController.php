<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use App\Http\Requests;
use Response;

class CustomerController extends Controller
{
    
// -----------------------------view------------------------------//
	public function index()
    {
        $customer = Customer::all();
        // return $customer;
        return Response::json([
                'data' => $this->transformCollection($customer)
        ], 200);
    }
 
	public function show($id)
    {
        $customer = Customer::where('nik',$id)->first();
 
        if(!$customer){
            return Response::json([
                'error' => [
                    'message' => 'Joke does not exist'
                ]
            ], 404);
        }
 
        return Response::json([
                'data' => $this->transform($customer)
        ], 200);
	}


	private function transformCollection($customer){
    	return array_map([$this, 'transform'], $customer->toArray());
	}
 
	private function transform($customer){
    	return [
             
        	    'id' => $customer['id'],
           		'nik' => $customer['nik'],
           		'name' => $customer['name'],
           		'telephone' => $customer['telephone'],
           		'city' => $customer['city'],
              
        	];
		}

// --------------------------------insert--------------------------------------//
	 public function store(Request $request)
    {


        $customer = Customer::create($request->all());

        return Response::json([
                'message' => 'Joke Created Succesfully',
                'data' => $this->transform($customer)
        ]);
    }
// ----------------------------update--------------------------------------------//

	public function update(Request $request, $id)
    {    
        // if(! $request->body or ! $request->user_id){
        //     return Response::json([
        //         'error' => [
        //             'message' => 'Please Provide Both body and user_id'
        //         ]
        //     ], 422);
        // }

        
        $customer = Customer::find($id);
        $customer->nik = $request->nik;
        $customer->name = $request->name;
        $customer->telephone = $request->telephone;
        $customer->city = $request->city;

        $customer->save(); 

        return Response::json([
                'message' => 'Customer Updated Succesfully'
        ]);
    }

// ---------------------------delete----------------------------//
   public function destroy($id)
    {
        Customer::destroy($id);
        return Response::json([
                'message' => 'Customer Deleted Succesfully'
        ]);
    }


	public function __construct(){
        $this->middleware('jwt.auth');
	}
}
