<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Stock;
use App\Models\InvTran;
use App\Models\Requisition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequisitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requisition = Requisition::get();
        return json_encode($requisition);
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
            $suffix = "REQ-" . substr(date("Y", time()), 2, 2) . "-";
            $recev=Requisition::whereYear('created_at',date('Y'))->orderBy('id','desc')->first();
            $no=1;
            if(!empty($recev->suffix_no))
            {
                $no=$recev->suffix_no+1;
            }
			$sys_no = $suffix . "" . str_pad($no, 5, '0', STR_PAD_LEFT);
            $newRecv=Requisition::create([
                'suffix_no'     => $no,
                'sys_no'        => $sys_no,
                'qty'           => 0,
                'price'        => 0 
            ]);
            $qnt=0;
            $price=0;
            foreach(json_decode($request->input('items')) as $items)
            {
                $recv_data=explode(",",$items->mst_id);
                for( $i=0 ; $i < count($recv_data) ; $i++)
                {
                    $inv_data=explode("_",$recv_data[$i]);
                    InvTran::create([
                        'mst_id'          => $newRecv->id,
                        'parent_mst_id'   => $inv_data[0],
                        'parent_dtls_id'  => $inv_data[1],
                        'item_id'         => $items->item,
                        'qty'             => 1,
                        'price'           => $items->price,
                        'type'            => 2
                    ]);
                    $inv_trans=InvTran::findOrFail($inv_data[1]);
                    $inv_trans->update(['req' => 1]);
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
               throw new Exception("There is something error");
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
     * @param  \App\Models\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function show(Requisition $requisition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function edit(Requisition $requisition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Requisition $requisition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requisition $requisition)
    {
        if($requisition->status!=1){
            $invTrans=InvTran::where('type' ,2 ) -> where('mst_id',$requisition->id)->get();
            foreach($invTrans as $inv)
            {
                $inv->delete();
            }
            $requisition->delete();
        }
    }
    public function requisitionApprove($id)
    {
        $requisition=Requisition::find($id);
        if($requisition->status==0){
            $requisition->update(['status'=>1]);
        }
        else
        {
            $invTrans=InvTran::where('type' ,3 ) -> where('parent_mst_id',$requisition->id)->count();
            if($invTrans==0)
            {
                $requisition->update(['status'=>0]);
            }
        }
        return json_encode($requisition);
    }
    public function searchRequisition(Request $request)
    {
        $requisition=Requisition::where('sys_no','like','%'.$request->requisition_no.'%')->get();
        return json_encode($requisition);
    }
}
