<?php

namespace App\Http\Controllers\Backend;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserRoleController extends Controller
{
    //index file view load
    public function index(){
        $pageTitle = 'User List';
        $users = Admin::latest()->paginate(10);
        return view('backend.pages.user.index', compact('pageTitle' , 'users'));

    }

    // category store in database
    public function store(Request $request){

        $request -> validate([
            'name' => 'required|max:50',
            'email' => 'required|email|unique:admins,email',
        ]);



        Admin::create([
            'name' => $request -> name,
            'email' => $request -> email,
            'password' => Hash::make('123456'),
            'orders'   =>$request -> orders,
            'Deliverymen'   =>$request -> Deliverymen,
            'deliverymethod'   =>$request -> deliverymethod,
            'database_backup'   =>$request -> database_backup,
            'cache'   =>$request -> cache,
            'user'   =>$request -> user,
        ]);

        return redirect()->back()->with('success' , 'User Added Successfully');

    }

    // category edit data return
    public function edit($id){
        $edit_data = Admin::findOrFail($id);

        return $edit_data;

    }

    // category update
    public function update(Request $request){
        $request -> validate([
            'name' => 'required|max:50',
            'email' => 'required|email|unique:admins,email,'.$request -> id,
        ]);

        $update_data = Admin::findOrFail($request -> id);
        $update_data -> name = $request -> name;
        $update_data -> email = $request -> email;
        $update_data -> orders = $request -> orders;
        $update_data -> deliverymethod = $request -> deliverymethod;
        $update_data -> Deliverymen = $request -> Deliverymen;
        $update_data -> user = $request -> user;
        $update_data -> database_backup = $request -> database_backup;
        $update_data -> cache = $request -> cache;
        $update_data -> update();

        return redirect()->back()->with('success','User Updated Successfully!');

    }

    // category delete
    public function destroy(Request $request){
        $delete_data = Admin::findOrFail($request -> id);
        unlinkFile(public_path('backend/uploads/admin/'.$delete_data -> profile));
        $delete_data -> delete();
        return redirect()->back()->with('success','User Deleted Successfully!');

    }
}
