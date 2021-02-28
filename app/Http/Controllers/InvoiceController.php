<?php

namespace App\Http\Controllers;

use App\Details;
use App\Item;
use App\Master;
use App\User;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Master::all();
        dd($invoices);
        return view('invoice.index',compact('invoices'));
        //
    }


    public function create()
    {
        \request()->validate([
            'name' => 'required|max:7',
            'price' => 'numeric',
            'qty' => 'numeric',
        ]);

        Item::create([
            'name' => \request()->name,
            'master_id'=>\request()->itemId
        ]);
        Details::create([
            'qty'=>\request()->qty,
            'price'=>\request()->price,
            'item_id'=>\request()->itemId,
            'total' => \request()->price * \request()->qty
        ]);

    }


    public function store(Request $request)
    {

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $invoice = Master::findOrFail($id);

        $item= Item::where('id',$invoice->item_id)->first();


//        $details = Details::with('item')->where('id',$item ? $item->details_id :'')->get();

        $items = Item::with('details')->where('master_id',$invoice->id)->get();
//        dd($items);
//            dd(Item::where('id',$invoice->item_id)->get());
//            dd($details);

        $users = User::all();
//        dd($item , $details , $users);

            return view('invoice.edit',['items'=>$items,'invoice'=>$invoice,'users'=>$users,'item'=>$item]);

    }


    public function update(Request $request, $id)
    {
        $invoice = Master::findOrFail($id);
//        $details = Details::with('item')->where('id',$item->details_id)->first();
//       $data = $details->update([
//            'price'=>\request()->price,
//            'qty'=>\request()->qty,
//        ]);
//       $data1 =$details->item->update([
//           'name' => \request()->name,
//       ]);
        $invoice->update([
            'invoice_name'=>\request()->invoice_name,
            'invoice_number'=>\request()->invoice_number,
            'user_id'=>\request()->user_id,
            'item_id'=>\request()->item_id,
            'date'=>\request()->date,
        ]);

        return response()->json(['msg'=>'Success']);
        //
    }


    public function destroy($id)
    {
        $item =  Item::where('id',$id)->delete();

        return response()->json([
            'msg'=>'Delete Done'
        ]);
        //
    }
}
