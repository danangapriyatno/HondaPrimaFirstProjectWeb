<?php

namespace App\Http\Controllers;

use App\Customerterm;
use Illuminate\Http\Request;
use App\Http\Requests;
use Response;

class CustomerTermController extends Controller
{
        
// -----------------------------view------------------------------//
	public function index(){
        $customer_term = Customerterm::all();
        return Response::json([
                'data' => $this->transformCollection($customer_term)
        ], 200);
	}
 
	public function show($id){
        $customer_term = Customerterm::find($id);
 
        if(!$customer_term){
            return Response::json([
                'error' => [
                    'message' => 'Joke does not exist'
                ]
            ], 404);
        }
 
        return Response::json([
                'data' => $this->transform($customer_term)
        ], 200);
	}




	private function transformCollection($customer_term){
    	return array_map([$this, 'transform'], $customer_term->toArray());
	}
 
	private function transform($customer_term){
    	return [
        	   'id' => $customer_term['id'],
           		'nik' => $customer_term['nik'],
           		'name' => $customer_term['name'],
           		'telephone' => $customer_term['telephone'],
           		'city' => $customer_term['city'],
                'customer_id' => $customer_term['customer_id']
        	];
		}
// --------------------------------insert--------------------------------------//
	 public function store(Request $request)
    {


        $customer_term = Customerterm::create($request->all());

        return Response::json([
                'message' => 'Customer Term Created Succesfully',
                'data' => $this->transform($customer_term)
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
        
        $customer_term = Customerterm::find($id);
        $customer_term->nik = $request->nik;
        $customer_term->name = $request->name;
        $customer_term->telephone = $request->telephone;
        $customer_term->city = $request->city;
        $customer_term->customer_id = $request->customer_id;

        $customer_term->save(); 

        return Response::json([
                'message' => 'Customer Term Updated Succesfully'
        ]);
    }
// ---------------------------delete----------------------------//
   public function destroy($id)
    {
        Customerterm::destroy($id);
        return Response::json([
                'message' => 'Customer Term Deleted Succesfully'
        ]);
    }


	public function __construct(){
        $this->middleware('jwt.auth');
	}


}
