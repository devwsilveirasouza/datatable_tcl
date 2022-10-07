<?php

namespace App\Http\Controllers;

use App\Models\PostModel;
use Illuminate\Http\Request;

class DatatableController extends Controller
{
    public function index(){
        return view('datatables.list', [] );
    }

    public function posts(Request $request){
        $info = [
            "draw" => $request->draw,
            "data" => [],
            "total" => 0,
        ];

        $posts = PostModel::take(10)->skip(0)->get();

        // $info['total'] = PostModel::count();

        $sl_no_counter = 0;
        foreach( $posts as $post ){
            $post->sl_no = $sl_no_counter+1;
        }

        $info['data'] = $post;

        return $info;
    }
}
