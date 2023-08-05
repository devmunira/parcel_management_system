<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Order;
use App\Models\Delivery;
use Illuminate\Http\Request;
use App\Exports\OrdersExport;
use App\Exports\OrderTrashExport;
use App\Models\Deliverymethod;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    //order index pgae view return
    public function index(){
        $pageTitle = 'All Orders';
        $orders = Order::latest()->with('delivery' , 'deliverymethod')->paginate(20);
        $grand = $orders -> sum('grand_total');
        $shipping_charge = $orders -> sum('shipping_charge');
        $methods = Deliverymethod::all();
        $mans = Delivery::all();
        return view('backend.pages.order.index' , compact('pageTitle' , 'orders' , 'methods' , 'mans' , 'shipping_charge' , 'grand' ));
    }

    //order index pgae view return
    public function create(){
        $pageTitle = 'Create New Order';
        $methods = Deliverymethod::all();
        $mans = Delivery::all();
        return view('backend.pages.order.create' , compact('pageTitle' , 'methods' , 'mans'));
    }

     //order index pgae view return
     public function edit($id){
        $pageTitle = 'Edit Order';
        $methods = Deliverymethod::all();
        $mans = Delivery::all();
        $order =  Order::where('id' , $id)->with('delivery' , 'deliverymethod')->first();
        if($order == NULL){
            $order = Order::withTrashed()->where('id' , $id)->with('delivery' , 'deliverymethod')->first();
        }
        return view('backend.pages.order.edit' , compact('pageTitle' , 'methods' , 'mans' , 'order'));
    }

    // public function store
    public function store(Request $request){
        $admin_id = Auth::guard('admin')->user()->id;
        $rules = 'required|max:255';
        $request -> validate([
            'name'  => $rules,
            'phone' => ['required','regex:/(^(\+88|0088)?(01){1}[3456789]{1}(\d){8})$/' ,],
            'ad_phone' => ['nullable','regex:/(^(\+88|0088)?(01){1}[3456789]{1}(\d){8})$/'],
            'address' => 'nullable|max:255',
            'comments' => 'nullable|max:255',
            'product' => $rules,
            'qnty'  => ['nullable','numeric'],
            'price'  => ['required','numeric'],
            'discount'  => ['nullable','numeric'],
            'shipping'  => ['nullable','numeric'],
            'grand_total'  => ['nullable','regex:/(0-9)*/'],
            'charge' => 'required',
            'area' => 'required',
            'method' => 'required',
            'man' => 'required'
        ]);
        $order_number = '';
        if($request->invoice){
            $order_number = $request -> invoice;
        }else{
            // generate order number
            $characters = 'DZ';
            // generate a pin based on 2 * 7 digits + a random character
            $pin =  mt_rand(100000, 999999). mt_rand(100000, 999999);
            // shuffle the result
            $order_number = $characters . $pin ;
        }


       try {
       $order =  Order::create([
            'name' => $request -> name,
            'phone' => $request -> phone,
            'ad_phone' => $request -> ad_phone,
            'address' => $request -> address,
            'status' => $request -> status,
            'deliverymethod_id' => $request -> method,
            'delivery_id' => $request -> man,
            'comments' => $request -> comments,
            'quantity' => $request -> qnty,
            'price' => $request -> price,
            'discount' => $request -> discount,
            'shipping_charge' => $request -> shipping,
            'total' => $request -> total,
            'area' => $request -> area,
            'delivery_method_type' => $request -> charge,
            'order_number' => $order_number,
            'product' => $request -> product,
            'admin_id' => $admin_id,
            'grand_total' => $request -> grand_total,
        ]);


        $mess='প্রিয় গ্রাহক,DEMAND ZONE এ আপনার  অর্ডারকৃত পণ্যটি ডেলিভারির জন্য প্রস্তুত| ধন্যবাদ। প্রয়োজনেঃ 01868612341';
        $to = $request -> phone;
        $token = "6710152810422dadb9926d379806ebdd96bf2d14de";
        $message = $mess;

        $url = "http://api.greenweb.com.bd/api.php";


        $data= array(
        'to'=>"$to",
        'message'=>"$message",
        'token'=>"$token"
        ); // Add parameters in key value
        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $smsresult = curl_exec($ch);


        return view('backend.pages.order.view' , compact('order'));
       } catch (\Throwable $th) {
        return redirect() -> back() -> with('error' , 'Something went wrong');
        // Throw $th;
       }
    }

    public function update(Request $request){
        $admin_id = Auth::guard('admin')->user()->id;
        $rules = 'required|max:255';
        $request -> validate([
            'name'  => $rules,
            'phone' => ['required','regex:/(^(\+88|0088)?(01){1}[3456789]{1}(\d){8})$/'],
            'ad_phone' => ['nullable','regex:/(^(\+88|0088)?(01){1}[3456789]{1}(\d){8})$/'],
            'address' => 'nullable|max:255',
            'comments' => 'nullable|max:255',
            'product' => $rules,
            'qnty'  => ['nullable','numeric'],
            'price'  => ['required','numeric'],
            'discount'  => ['nullable','numeric'],
            'shipping'  => ['nullable','numeric'],
            'grand_total'  => ['nullable','regex:/(0-9)*/'],
            'charge' => 'required',
            'area' => 'required',
            'method' => 'required',
            'man' => 'required'
        ]);
       try {
        $update_data = Order::findOrFAil($request ->id);
            $update_data -> name= $request -> name;
            $update_data -> phone= $request -> phone;
            $update_data -> ad_phone= $request -> ad_phone;
            $update_data -> address= $request -> address;
            $update_data -> status= $request -> status;
            $update_data -> deliverymethod_id= $request -> method;
            $update_data -> delivery_id= $request -> man;
            $update_data -> comments= $request -> comments;
            $update_data -> quantity= $request -> qnty;
            $update_data ->  price= $request -> price;
            $update_data -> discount= $request -> discount;
            $update_data -> shipping_charge= $request -> shipping;
            $update_data -> total= $request -> total;
            $update_data -> delivery_method_type= $request -> charge;
            $update_data -> order_number= $update_data -> order_number;
            $update_data -> product= $request -> product;
            $update_data -> grand_total= $request -> grand_total;
            $update_data -> admin_id= $admin_id;
            $update_data ->update();
            return redirect() -> back() -> with('success' , 'Order Invoice Updated Successfully!');
       } catch (\Throwable $th) {
            return redirect() -> back() -> with('error' , 'Something went wrong');
       }
    }


    public function orderinvoice($order_number , $id){
        $order =  Order::where('order_number' , $order_number)->where('id' , $id)->with('delivery' , 'deliverymethod')->first();
        if($order == NULL){
            $order =  Order::withTrashed()->where('order_number' , $order_number)->where('id' , $id)->with('delivery' , 'deliverymethod')->first();
        }
        $order -> status = 'Sent';
        $order -> update();
        return view('backend.pages.order.view' , compact('order'));
    }

    public function download($id){
        $order =  Order::where('id' , $id)->with('delivery' , 'deliverymethod')->first();
        if($order == NULL){
            $order =  Order::withTrashed()->where('id' , $id)->with('delivery' , 'deliverymethod')->first();
        }
        $method = '';
        $method = $order -> deliverymethod -> name;
        $man = '';
        $number = '';
        if($order -> delivery){
            $man = $order -> delivery -> name;
            $number = $order -> delivery -> phone;
        }

        $order = [
            'name' => $order -> name,
            'phone' => $order -> phone,
            'ad_phone' => $order -> ad_phone,
            'address' => $order -> address,
            'status' => $order -> status,
            'method' => $method,
            'man' => $man,
            'comments' => $order -> comments,
            'quantity' => $order -> qnty,
            'price' => $order -> price,
            'discount' => $order -> discount,
            'shipping_charge' => $order -> shipping_charge,
            'total' => $order -> total,
            'delivery_method_type' => $order -> delivery_method_type,
            'order_number' => $order -> order_number,
            'product' => $order -> product,
            'id' => $order -> id,
            'created_at' => $order -> created_at,
            'number' => $number,
        ];

        $pdf = PDF ::loadView ('backend.pages.order.download', $order);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download ('invoice-pdf.pdf');
    }



    public function destroy(Request $request){
        try {
             $order = Order::where('id' , $request-> id)->first();
             if($order){
                 $order -> delete();
             }else{
                $order = Order::withTrashed()->where('id' , $request-> id)->first();
                $order -> delete();
             }
            return redirect() -> back() -> with('error' , 'Order has been Move to trash Sucessfully!');
        } catch (\Throwable $th) {
            redirect() -> back() -> with('error' , 'Something went wrong');
        }

    }

    // Search Method
    public function search(Request $request){
        // dd(array($request->area));
        $orders =  Order::where('status', 'like', '%' . $request->status . '%')
        ->where('delivery_id', 'like', '%' . $request->man . '%')
        ->where('deliverymethod_id', 'like', '%' . $request->method . '%')
        ->where('order_number', 'like', '%' . $request->search . '%')
        // ->where('area',  'LIKE' , "%\"{$request -> area}\"%")
        ->where('phone', 'like',  '%' .$request->number.'%')
        ->with('delivery' , 'deliverymethod')->paginate(20);
        $grand = $orders->sum('grand_total');
        $shipping_charge = $orders-> sum('shipping_charge');

        $pageTitle = 'All Orders';
        $methods = Deliverymethod::all();
        $mans = Delivery::all();

        return view('backend.pages.order.index' , compact('pageTitle' , 'orders' , 'methods' , 'mans' ,  'shipping_charge' , 'grand'));
    }

     // Search Method
     public function trashsearch(Request $request){
        $orders =  Order::onlyTrashed()->where('status', 'like', '%' . $request->status . '%')
        ->where('delivery_id', 'like', '%' . $request->man . '%')
        ->where('deliverymethod_id', 'like', '%' . $request->method . '%')
        ->where('order_number', 'like', '%' . $request->search . '%')
        ->where('phone', 'like',  '%' .$request->number.'%')
        ->with('delivery' , 'deliverymethod')->paginate(20);
        $grand = $orders->sum('grand_total');
        $shipping_charge = $orders-> sum('shipping_charge');

        $pageTitle = 'All Orders';
        $methods = Deliverymethod::all();
        $mans = Delivery::all();



        return view('backend.pages.order.trash' , compact('pageTitle' , 'orders' , 'methods' , 'mans' ,  'shipping_charge' , 'grand'));
    }


    // Status Update
    public function status(Request $request , $id , $status){
        try {
            $data = Order::findOrFail($id);
            if($data == NULL){
                $data = Order::withTrashed()->findOrFail($id);
            }
            $data -> status = $status;
            $data -> update();
            return true;
        } catch (\Throwable $th) {
           return false;
        }
    }


    // view All Trash Order
    public function trash(){
        $pageTitle = 'All Trash Orders';
        $orders = Order::onlyTrashed()->with('delivery' , 'deliverymethod')->paginate(20);
        $methods = Deliverymethod::all();
        $mans = Delivery::all();
        return view('backend.pages.order.trash' , compact('pageTitle' , 'orders' , 'methods' , 'mans' ));
    }

     // view All Trash Order
     public function forcedelete(Request $request){
        try {
           Order::withTrashed()->where('id' , $request-> id)->first()->forcedelete();
           return redirect() -> back() -> with('error' , 'Order has been Parmanently deleted!');
       } catch (\Throwable $th) {
           redirect() -> back() -> with('error' , 'Something went wrong');
       }
    }

    // Trsah Order Restore
    public function restore(Request $request){
        // dd($request -> all());
        try {
           Order::withTrashed()->where('id' , $request-> id)->first()->restore();
           return redirect() -> back() -> with('success' , 'Order has been Restored!');
       } catch (\Throwable $th) {
           redirect() -> back() -> with('error' , 'Something went wrong');
       }
    }

     // Search Method
     public function report(Request $request){
        $form = $request -> start;
        $to  = $request -> end;
       if($request->area == 'All'){
            if($request -> end == $request ->start || $request -> end == NULL){
                $orders =  Order::where('created_at'  , $form)->with('delivery' , 'deliverymethod')->paginate(20);
            }else{
                $orders =  Order::where('created_at' , '>=' , $form)->where('created_at' , '<=' , $to)->with('delivery' , 'deliverymethod')->paginate(20);
            }
       }else{
            if($request -> end == $request ->start || $request -> end == NULL){
                $orders =  Order::where('created_at'  , $form)->with('delivery' , 'deliverymethod')->paginate(20);
            }else{
                $orders =  Order::where('area',  'LIKE' , "%\"{$request -> area}\"%")->where('created_at' , '>=' , $form)->where('created_at' , '<=' , $to)->with('delivery' , 'deliverymethod')->paginate(20);
            }
       }
        $grand = $orders->sum('grand_total');
        $shipping_charge = $orders-> sum('shipping_charge');
        $pageTitle = 'All Reports';
        $methods = Deliverymethod::all();
        $mans = Delivery::all();
        return view('backend.pages.report.index' , compact('pageTitle' , 'orders' , 'methods' , 'mans' ,  'shipping_charge' , 'grand'));
    }

    public function reportindex(){
        $pageTitle = 'All Orders';
        $methods = Deliverymethod::all();
        $mans = Delivery::all();
        $orders = Order::latest()->with('delivery' , 'deliverymethod')->where('created_at' , NULL)->paginate(20);
        $grand = $orders->sum('grand_total');
        $shipping_charge = $orders-> sum('shipping_charge');
        return view('backend.pages.report.index' , compact('pageTitle' , 'methods' , 'mans' , 'orders' , 'shipping_charge' , 'grand'  ));
    }

    public function printall(Request $request){
        $orders = Order::whereIn('id' , $request->ids)->with('delivery' , 'deliverymethod')->get();
        if(count($orders) <= 0){
            $orders = Order::withTrashed()->whereIn('id' , $request->ids)->with('delivery' , 'deliverymethod')->get();
        }

        foreach($orders as $order){
            $order -> status = 'Sent';
            $order -> update();
        }

        return view('backend.pages.order.view_all' , compact('orders'));

    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function export(Request $request)
    {
        $orders_id = array_keys($request->all());
        return Excel::download(new OrdersExport($orders_id), 'orders.xlsx');

    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function csv(Request $request)
    {
        $orders_id = array_keys($request->all());
        return Excel::download(new OrdersExport($orders_id), 'orders.csv');

    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function exporttrash(Request $request)
    {
        $orders_id = array_keys($request->all());
        return Excel::download(new OrderTrashExport($orders_id), 'orders.xlsx');

    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function csvtrash(Request $request)
    {
        $orders_id = array_keys($request->all());
        return Excel::download(new OrderTrashExport($orders_id), 'orders.csv');

    }

    // phone serch
    public function phoneserch($phone){
        $order = Order::where('ad_phone'  , $phone)->orWhere('phone' , $phone)->select(['address' , 'name'])->first();
        if($order){
            return $order;
        }else{
            return false;
        }
    }

}
