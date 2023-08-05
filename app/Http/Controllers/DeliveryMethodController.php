<?php

namespace App\Http\Controllers;

use App\Models\Deliverymen;
use App\Models\Deliverymethod;
use Illuminate\Http\Request;

class DeliveryMethodController extends Controller
{
     //index page view
     public function index(){
        $pageTitle = 'Delivery Method';
        $methods = Deliverymethod::latest()->paginate(10);
        return view('backend.pages.deliverymethod.index' , compact('pageTitle' , 'methods'));
    }

    // delivery man create
    public function store(Request $request){
        $rules = 'required|max:255';
        $request->validate([
            'name' => $rules,
        ]);
        Deliverymethod::create(['name' => $request -> name]);
        return redirect() -> back () -> with ('success' , 'Delivery Method Added Successfully!');
    }

    // Delivery man update
    public function update(Request $request){
        $rules = 'required|max:255';
        $request->validate([
            'name' => $rules,
        ]);
        try {
            $update_data = Deliverymethod::findOrFail($request -> id);
            $update_data -> name = $request -> name;
            $update_data -> update();
            return redirect() -> back () -> with ('success' , 'Data Updated Successfully!');
         } catch (\Throwable $th) {
            throw $th;
        }


    }

    // Delievey man delete
    public function destroy(Request $request){
        delete($request -> id , 'App\Models\Deliverymethod' , '' , '');
        return redirect() -> back () -> with ('error' , 'Data Deleted Successfully!');
    }

    // Dleivery Edit data
    public function edit($id){
       $edit = Deliverymethod::find($id);
       if($edit){
           return $edit;
       }else{
           return false;
       }
    }

}
