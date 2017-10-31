<?php

namespace App\Http\Controllers;

use App\DiscountOtrVehicle;
use Illuminate\Http\Request;
use App\Http\Requests;
use Response;


class DiscountOtrVehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // -----------------------------view------------------------------//
    public function index(){
        $discountotr = DiscountOtrVehicle::all();
        return Response::json([
                'data' => $this->transformCollection($discountotr)
        ], 200);
    }
 
    public function show($id){
        $discountotr = DiscountOtrVehicle::find($id);
 
        if(!$discountotr){
            return Response::json([
                'error' => [
                    'message' => 'Joke does not exist'
                ]
            ], 404);
        }
 
        return Response::json([
                'data' => $this->transform($discountotr)
        ], 200);
    }




    private function transformCollection($discountotr){
        return array_map([$this, 'transform'], $discountotr->toArray());
    }
 
    private function transform($discountotr){
        return [
               'id' => $discountotr['id'],
                'discount' => $discountotr['discount'],
                'otr' => $discountotr['otr'],
                'vehicles_id' => $discountotr['vehicles_id'],

            ];
        }
// --------------------------------insert--------------------------------------//
     public function store(Request $request)
    {


        $discountotr = DiscountOtrVehicle::create($request->all());

        return Response::json([
                'message' => 'Joke Created Succesfully',
                'data' => $this->transform($discountotr)
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
        
        $discountotr = DiscountOtrVehicle::find($id);
        $discountotr->discount = $request->discount;
        $discountotr->otr = $request->otr;
        $discountotr->vehicles_id = $request->vehicles_id;

        $discountotr->save(); 

        return Response::json([
                'message' => 'Customer Updated Succesfully'
        ]);
    }
// ---------------------------delete----------------------------//
   public function destroy($id)
    {
        DiscountOtrVehicle::destroy($id);
        return Response::json([
                'message' => 'Customer Deleted Succesfully'
        ]);
    }


    public function __construct(){
        $this->middleware('jwt.auth');
    }

     
}
