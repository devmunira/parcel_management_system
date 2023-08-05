<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use Illuminate\Http\Request;

class DeliverymanController extends Controller
{
    //index page view
    public function index(){
        $pageTitle = 'Delivery Man';
        $mans = Delivery::latest()->paginate(10);
        return view('backend.pages.deliveryman.index' , compact('pageTitle' , 'mans'));
    }

    // delivery man create
    public function store(Request $request){
        $rules = 'required|max:255';
        $request->validate([
            'name' => $rules,
            'phone' => ['required','regex:/(^(\+88|0088)?(01){1}[3456789]{1}(\d){8})$/'] ,
            'address' => $rules,
        ]);

        Delivery::create([
            'name' => $request -> name,
            'phone' => $request -> phone,
            'address' => $request -> address,
        ]);

        return redirect() -> back () -> with ('success' , 'One More Delivery Men Added Successfully!');
    }

    // Delivery man update
    public function update(Request $request){
        $rules = 'required|max:255';
        $request->validate([
            'name' => $rules,
            'phone' => ['required','regex:/(^(\+88|0088)?(01){1}[3456789]{1}(\d){8})$/'] ,
            'address' => $rules,
        ]);

        try {
            $update_data = Delivery::findOrFail($request -> id);
            $update_data -> name = $request -> name;
            $update_data -> phone = $request -> phone;
            $update_data -> address = $request -> address;
            $update_data -> update();
            return redirect() -> back () -> with ('success' , 'Data Updated Successfully!');
         } catch (\Throwable $th) {
            throw $th;
        }


    }

    // Delievey man delete
    public function destroy(Request $request){
        delete($request -> id , 'App\Models\Delivery' , '' , '');
        return redirect() -> back () -> with ('error' , 'Data Deleted Successfully!');
    }

    // Dleivery Edit data
    public function edit($id){
       $edit = Delivery::find($id);
       if($edit){
           return $edit;
       }else{
           return false;
       }
    }


}
