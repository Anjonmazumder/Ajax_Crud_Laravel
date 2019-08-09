<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Itemlist;

class ListController extends Controller {

    public function index() {
        $items = Itemlist::all();
        //return $items;
        return view('list', ['items' => $items]);
        //return response()->json($items);
    }

    public function addItem(Request $request) {
        //return $request->all();
        $items = new Itemlist();
        $items->item_name = $request->itemName;

        $items->save();
        //return redirect('add-food');
        return response()->json($items);
    }

    public function deleteItem(Request $request) {
        Itemlist::where('id', $request->id)->delete();
        return $request->all();
    }

    public function UpdateItem(Request $request) {
        $item = Itemlist::find($request->id);
        //return $item;


        $item->item_name = $request->itemName;

        $item->save();
        return $request->all();
    }

    public function searchItem(Request $request) {
        $term = $request->term;
        $items = Itemlist::where('item_name', 'LIKE', '%' . $term . '%')->get();
        if(count($items)==0){
            $searchResult[] ='No Items Found';
            
        }
        else{
             foreach($items as $item){
                 $searchResult[] =$item->item_name;
                 
             }
            
        }
        return $searchResult;
    }

}
