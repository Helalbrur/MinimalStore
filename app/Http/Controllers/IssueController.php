<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\InvTran;
use App\Models\Requisition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function show(Issue $issue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function edit(Issue $issue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Issue $issue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Issue $issue)
    {
        //
    }
    public function requisitionItemForIssue(Request $request)
    {
        // DB::enableQueryLog();
        $items=InvTran::where('mst_id',$request->id)->where('type',2)->where('req',0)->get();
        // dd(DB::getQueryLog());

        // return json_encode($items);
        $data=[];
        $data['qty']= 0;
        $data['price'] = 0;
        $mst_ids=array();
        foreach($items as $item)
        {
            $data['qty']+= $item->qty;
            $data['price']+= $item->price;
            $data['item_id'] = $item->item_id;
            array_push($mst_ids,$item->mst_id .'_'.$item->id);
        }
        $data['mst_id'] =implode(",",$mst_ids);
        return json_encode($data);
    }
}
