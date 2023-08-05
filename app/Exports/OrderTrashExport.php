<?php

namespace App\Exports;
use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromQuery;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderTrashExport implements FromQuery, WithHeadings , WithMapping
{
    use Exportable;


    protected $ids;

    public function __construct($orders_id)
    {
        $this -> ids = $orders_id;
    }

    public function map($order): array
    {
        return [
            $order->id,
            $order->order_number,
            $order->admin->name,
            $order->name,
            $order->address,
            $order->phone,
            $order->product,
            $order->quantity,
            $order->price,
            $order->shipping_charge,
            $order->discount,
            $order->total,
            $order->area,
            $order->deliverymethod->name,
            $order->delivery->name,
            $order->created_at,
            $order->comments,
            $order->status,
        ];
    }

    public function headings(): array
    {
        return [
            '#ID',
            'Invoice Number',
            'Invoice Officer',
            'Customer Name',
            'Customer Address',
            'Customer Phone',
            'Product Name',
            'Quntity',
            'Price',
            'Shipping Charge',
            'Discount',
            'Total',
            'Shipping Area',
            'Delivery Method',
            'Delivery Man',
            'Date',
            'Comments',
            'Status',
        ];
    }

    public function query()
    {
        return Order::query()->withTrashed()->with(['admin' , 'delivery' , 'deliverymethod'])->whereIn('id',  $this -> ids);
    }
}
