<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Poll;
use App\Models\Order;
use App\Models\Notice;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BackendController extends Controller
{
    //return the dashboard page
    public function index(){
        $shipping_charge = Order::sum('shipping_charge');
        $avg = Order::all()->sum('total');
        $product_sold = Order::whereNotIn('status' , ['Return'])->sum('quantity');
        $orders = Order::whereNotIn('status' , ['Return'])->count();
        $total_return = Order::where('status' , 'Return')->count();
        $completed = Order::where('status' , 'Completed')->count();
        $total_sent = Order::where('status' , 'Sent')->count();
        $total_approved = Order::where('status' , 'Approved')->count();
        $inside_metro = Order::whereJsonContains('area' , 'Inside Metro')->count();
        $outside_metro = Order::whereJsonContains('area' , 'Outside Metro')->count();
        $outside_dhaka = Order::whereJsonContains('area' , 'Outside Dhaka')->count();
        $today = Order::whereNotIn('status' , ['Return' , 'Completed' , 'Sent'])->whereDate('created_at', Carbon::today())->get();
        $grand = Order::whereDate('created_at', Carbon::today())->count();
        return view('backend.pages.home.home' , compact('grand' , 'product_sold' , 'orders' ,'avg' , 'total_return' , 'total_sent' , 'total_approved' , 'inside_metro' , 'outside_dhaka' , 'outside_metro' , 'shipping_charge' , 'completed' , 'today'));
    }

    //poll view return
    public function pollView(){
        $pageTitle = 'Poll List';
        $poll = Poll::latest()->get();
        return view('backend.pages.poll' , compact('pageTitle' , 'poll'));
    }

    //poll update and create method
    public function pollCreate(Request $request){
        $request -> validate([
            'question' => 'required|max:255',
            'option_one' => 'required|max:255',
            'option_two' => 'required|max:255',
        ]);

        Poll::create([
            'question' => $request -> question,
            'option_one' => $request -> option_one,
            'option_two' => $request -> option_two,
            'status'     => $request -> status,

        ]);

        return redirect()->back()->with('success' , 'Poll Created Successfully');
    }

    //poll update and create method
    public function pollUpdate(Request $request){
        $request -> validate([
            'question' => 'required|max:255',
            'option_one' => 'required|max:255',
            'option_two' => 'required|max:255',
        ]);

        $poll = Poll::findOrFail($request -> id);

        $poll -> question = $request -> question;
        $poll -> option_one = $request -> option_one;
        $poll -> option_two = $request -> option_two;
        $poll -> status = $request -> status;
        $poll -> update();

        return redirect()->back()->with('success' , 'Poll Updated Successfully');
    }

    // poll delete
    public function pollDelete (Request $request){
        Poll::findOrFail($request -> id)->delete();
        return redirect()->back()->with('error' , 'POll deleted Successfully');

    }

    // poll delete
    public function pollEdit (Poll $poll){
        return $poll;

    }

    //poll view return
    public function noticeView(){
        $pageTitle = 'notice Create';
        $notice = Notice::findOrFail(1);
        return view('backend.pages.notice' , compact('pageTitle' , 'notice'));
    }

    //notice update and create method
    public function noticeCreate(Request $request){
        $request -> validate([
            'notice' => 'required|max:255',
        ]);

        Notice::updateOrCreate(['id' => 1],[
            'notice' => $request -> notice,
            'status'     => $request -> status,
        ]);

        return redirect()->back()->with('success' , 'Notice Updated Successfully');
    }

    public function contact(){
        $contacts = Contact::latest()->paginate(10);
        $pageTitle = 'Contact List';
        return view('backend.pages.contact.index', compact('pageTitle' , 'contacts'));
    }
    public function contactShow($id){
        $contact = Contact::latest()->where('id' , $id)->first();
        return $contact;
        }

}
