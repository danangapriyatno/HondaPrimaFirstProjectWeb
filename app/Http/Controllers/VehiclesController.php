<?php

namespace App\Http\Controllers;

use App\Vehicle;
use Illuminate\Http\Request;
use App\Http\Requests;
use Response;

class VehiclesController extends Controller
{
               
// -----------------------------view------------------------------//
	public function index(){
        $type = Vehicle::all();
        return Response::json([
                'data' => $this->transformCollection($type)
        ], 200);
	}
 
	public function show($id){
        $type = Vehicle::find($id);
 
        if(!$type){
            return Response::json([
                'error' => [
                    'message' => 'Joke does not exist'
                ]
            ], 404);
        }
 
        return Response::json([
                'data' => $this->transform($type)
        ], 200);
	}




	private function transformCollection($type){
    	return array_map([$this, 'transform'], $type->toArray());
	}
 
	private function transform($type){
    	return [
        	   'id' => $type['id'],
           		'code_stock' => $type['code_stock'],
                'name' => $type['name'],
           		'colour' => $type['colour'],
           		'frame_no' => $type['frame_no'],
           		'machine_no' => $type['machine_no'],
           		'stock' => $type['stock'],
           		'customer_id' => $type['customer_id'],
           		'vehicles_type_id' => $type['vehicles_type_id'],
        	];
		}
// --------------------------------insert--------------------------------------//
	 public function store(Request $request)
    {


        $type = Vehicle::create($request->all());

        return Response::json([
                'message' => 'Joke Created Succesfully',
                'data' => $this->transform($type)
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
        
        $type = Vehicle::find($id);
        $type->code_stock = $request->code_stock;
        $type->name = $request->name;
        $type->colour = $request->colour;
        $type->frame_no = $request->frame_no;
        $type->machine_no = $request->machine_no;
        $type->stock = $request->stock;
        $type->customer_id = $request->customer_id;
        $type->vehicles_type_id = $request->vehicles_type_id;
        

        $type->save(); 

        return Response::json([
                'message' => 'Customer Updated Succesfully'
        ]);
    }
// ---------------------------delete----------------------------//
   public function destroy($id)
    {
        Vehicle::destroy($id);
        return Response::json([
                'message' => 'Customer Deleted Succesfully'
        ]);
    }


	public function __construct(){
        $this->middleware('jwt.auth');
	}

}
