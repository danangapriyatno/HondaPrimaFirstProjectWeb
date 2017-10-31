<?php

namespace App\Http\Controllers;

use App\Vehicletype;
use Illuminate\Http\Request;
use App\Http\Requests;
use Response;


class TypeController extends Controller
{
            
// -----------------------------view------------------------------//
	public function index(){
        $type = Vehicletype::all();
        return Response::json([
                'data' => $this->transformCollection($type)
        ], 200);
	}
 
	public function show($id){
        $type = Vehicletype::find($id);
 
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
           		'vehicles_name' => $type['vehicles_name']
        	];
		}
// --------------------------------insert--------------------------------------//
	 public function store(Request $request)
    {


        $type = Vehicletype::create($request->all());

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
        
        $type = Vehicletype::find($id);
        $type->vehicles_name = $request->vehicles_name;
        

        $type->save(); 

        return Response::json([
                'message' => 'Customer Updated Succesfully'
        ]);
    }
// ---------------------------delete----------------------------//
   public function destroy($id)
    {
        Vehicletype::destroy($id);
        return Response::json([
                'message' => 'Customer Deleted Succesfully'
        ]);
    }


	public function __construct(){
        $this->middleware('jwt.auth');
	}

}
