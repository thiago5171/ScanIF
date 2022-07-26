<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\StatusItem;


/**
 * Description of ItemController
 *
 * @author Tuhin Bepari <digitaldreams40@gmail.com>
 */

class ItemController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('pages.items.index', ['records' => Item::paginate(10)]);
    }    /**
     * Display the specified resource.
     *
     * @param  Request  $request
     * @param  Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Item $item)
    {
        return view('pages.items.show', [
                'record' =>$item,
        ]);

    }    /**
     * Show the form for creating a new resource.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
		$status_items = StatusItem::all(['id']);

        return view('pages.items.create', [
            'model' => new Item,
			"status_items" => $status_items,

        ]);
    }    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model=new Item;
        $model->fill($request->all());

        if ($model->save()) {
            
            session()->flash('app_message', 'Item saved successfully');
            return redirect()->route('items.index');
            } else {
                session()->flash('app_message', 'Something is wrong while saving Item');
            }
        return redirect()->back();
    } /**
     * Show the form for editing the specified resource.
     *
     * @param  Request  $request
     * @param  Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Item $item)
    {
		$status_items = StatusItem::all(['id']);

        return view('pages.items.edit', [
            'model' => $item,
			"status_items" => $status_items,

            ]);
    }    /**
     * Update a existing resource in storage.
     *
     * @param  Request  $request
     * @param  Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Item $item)
    {
        $item->fill($request->all());

        if ($item->save()) {
            
            session()->flash('app_message', 'Item successfully updated');
            return redirect()->route('items.index');
            } else {
                session()->flash('app_error', 'Something is wrong while updating Item');
            }
        return redirect()->back();
    }    /**
     * Delete a  resource from  storage.
     *
     * @param  Request  $request
     * @param  Item  $item
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Request $request, Item $item)
    {
        if ($item->delete()) {
                session()->flash('app_message', 'Item successfully deleted');
            } else {
                session()->flash('app_error', 'Error occurred while deleting Item');
            }

        return redirect()->back();
    }
}
