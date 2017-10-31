<?php

namespace App\Http\Controllers;

use App\Presale;
use Illuminate\Http\Request;
use App\Http\Requests;
use Response;

class SaleController extends Controller
{
    // -----------------------------view------------------------------//
	public function index(){
        $sale = Presale::all();
        return Response::json([
                'data' => $this->transformCollection($sale)
        ], 200);
	}
 
	public function show($id){
        $sale = Presale::find($id);
 
        if(!$sale){
            return Response::json([
                'error' => [
                    'message' => 'Joke does not exist'
                ]
            ], 404);
        }
 
        return Response::json([
                'data' => $this->transform($sale)
        ], 200);
	}




	private function transformCollection($sale){
    	return array_map([$this, 'transform'], $sale->toArray());
	}
 
	private function transform($sale){
    	return [
    													
        	   'id' => $sale['id'],
           		'payment' => $sale['payment'],
           		'otr' => $sale['otr'],
           		'down_payment' => $sale['down_payment'],
           		'discount' => $sale['discount'],
           		'leasing' => $sale['leasing'],
           		'installment' => $sale['installment'],
           		'tenor' => $sale['tenor'],
           		'program' => $sale['program'],
           		'presales_no' => $sale['presales_no'],
           		'vehicle_id' => $sale['vehicle_id'],
           		'customer_id' => $sale['customer_id'],
                'status' => $sale['status']
        	];
		}
// --------------------------------insert--------------------------------------//
	 public function store(Request $request)
    {


        $sale = Presale::create($request->all());

        return Response::json([
                'message' => 'Joke Created Succesfully',
                
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

        $sale = Presale::find($id);
        $sale->payment = $request->payment;
        
        $sale->otr = $request->otr;
        $sale->down_payment = $request->down_payment;
        $sale->discount = $request->discount;
        $sale->leasing = $request->leasing;
        $sale->installment = $request->installment;
        $sale->tenor = $request->tenor;
        $sale->program = $request->program;
        $sale->presales_no = $request->presales_no;
        $sale->vehicle_id = $request->vehicle_id;
        $sale->customer_id = $request->customer_id;
        $sale->status = $request->status;

       

        $sale->save(); 

        return Response::json([
                'message' => 'Customer Updated Succesfully'
        ]);
    }
// ---------------------------delete----------------------------//
   public function destroy($id)
    {
        Presale::destroy($id);
        return Response::json([
                'message' => 'Customer Deleted Succesfully'
        ]);
    }


	public function __construct(){
        $this->middleware('jwt.auth');
	}
}
