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
        // Filtro por data
        $from_date = ( $request->from_date )? $request->from_date : null;
        $to_date = ( $request->to_date )? $request->to_date : null;
        // Fim Filtro por data
        $search = $request->input('search.value');
        // Realiza o carregando das informações no datatable com os filtros "dataFilter"
        $posts = PostModel::orWhere( function( $query ) use ( $search ) {
            $query->where( "name", "LIKE", "%".$search."%" )
                ->orWhere( "slug", "LIKE", "%".$search."%" );
        })->dateFilter( $from_date, $to_date )->take( $request->length )->skip( $request->start )->get();
        // Realiza o carregando das informações no datatable com os filtros "dataFilter"
        $info['total'] = PostModel::orWhere( function( $query ) use ( $search ) {
            $query->where( "name", "LIKE", "%".$search."%" )
                ->orWhere( "slug", "LIKE", "%".$search."%" );
                })->dateFilter( $from_date, $to_date )->count();

        $sl_no_counter = ( $request->start == 0 ) ? 1 : $request->start;

        foreach( $posts as $post ){
            $post->sl_no = $sl_no_counter;
            $sl_no_counter++;
        }

        $info['data'] = $posts;

        return $info;
    }
}
