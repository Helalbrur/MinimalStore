<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Stock;
use App\Models\InvTran;
use App\Models\Receive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReceiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $receive=Receive::get();
        return json_encode($receive);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try 
        {
            $suffix = "RECV-" . substr(date("Y", time()), 2, 2) . "-";
            $recev=Receive::whereYear('created_at',date('Y'))->orderBy('id','desc')->first();
            $no=1;
            if(!empty($recev->suffix_no))
            {
                $no=$recev->suffix_no+1;
            }
			$sys_no = $suffix . "" . str_pad($no, 5, '0', STR_PAD_LEFT);
            $newRecv=Receive::create([
                'supplier_id'   => $request->input('supplier'),
                'suffix_no'     => $no,
                'sys_no'        => $sys_no,
                'qty'           => 0,
                'price'        => 0 
            ]);
            $qnt=0;
            $price=0;
            foreach(json_decode($request->input('items')) as $items)
            {
                $stock=Stock::where('item_id',$items->item)->first();
                if(!empty($stock->id))
                {
                    $stock->qty = $stock->qty + $items->qty;
                    $stock->price = $stock->price + $items->price;
                    $stock->save();
                }
                else
                {
                    Stock::create([
                        'item_id'   => $items->item,
                        'qty'       => $items->qty,
                        'price'     => $items->qty * $items->price,
                    ]);
                }
                for( $i=0 ; $i < $items->qty ; $i++)
                {
                    InvTran::create([
                        'mst_id'          => $newRecv->id,
                        'item_id'         => $items->item,
                        'qty'             => 1,
                        'price'           => $items->price,
                        'type'            => 1
                    ]);
                }
                $qnt+= $items->qty;
                $price+= ($items->price * $items->qty);
            }
            $newRecv->update([
                'qty'           => $qnt,
                'price'        => $price 
            ]);
            //dd($qnt);
            if($qnt==0){
                DB::rollBack();
            } 
            else {
                DB::commit();
            }
            return json_encode($newRecv);
        }
        catch (Exception $e) 
        {
            DB::rollBack();
            json_encode($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Receive  $receive
     * @return \Illuminate\Http\Response
     */
    public function show(Receive $receive)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Receive  $receive
     * @return \Illuminate\Http\Response
     */
    public function edit(Receive $receive)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Receive  $receive
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receive $receive)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Receive  $receive
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receive $receive)
    {
        $receive->delete();
    }

    public function receiveItemForRequisition(Request $request)
    {
       
        $items=InvTran::where('item_id',$request->item_id)->where('type',1)->where('req',0)->orderBy('id','asc')->take($request->qty)->get();
        $data=[];
        $data['item_id'] = $request->item_id;
        $data['qty']= 0;
        $data['price'] = 0;
        $mst_ids=array();
        foreach($items as $item){
            $data['qty']+= $item->qty;
            $data['price']+= $item->price;
            array_push($mst_ids,$item->mst_id .'_'.$item->id);
        }
        $data['mst_id'] =implode(",",$mst_ids);
        return json_encode($data);
    }
}
