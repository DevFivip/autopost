<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerSubreddit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UtilController extends Controller
{
    //

    public function util(Request $request)
    {
        $data = $request->all();
        $table = $data['table'];
        $query = "select id,name from $table";
        $res = DB::select($query);
        return response()->json(['data' => $res, 'status' => true]);
    }
    public function getSubredditsAssigned(Request $request)
    {
        $data = $request->all();
        $customer_id = $data['customer_id'];

        $_fecha = explode(" ",$data['fecha']);
        $fecha = $_fecha[0];

        $fechaInicio = $fecha . ' 00:00:00';

        $fechaFin =  $fecha . ' 23:59:59';

        $result = DB::table('events')
            ->where('customer_id', $customer_id)
            ->where('posted_at', '>=', $fechaInicio)
            ->where('posted_at', '<=', $fechaFin)
            ->whereNull('post_id')
            // ->join('posts', 'events.post_id', '=', 'posts.id')
            ->join('subreddits', 'events.subreddit_id', '=', 'subreddits.id')
            ->select('events.*', 'subreddits.*')
            ->get();

        $arr = collect($result)->map(function($b,$k){
            $e =  (object) [];
            $e->id = $b->subreddit_id;
            $e->name = $b->name." 📅";
            return $e;
        });

        $result2 = DB::table('customer_subreddits')
            ->where('customer_id', $customer_id)
            ->whereIn('verification_status', [1, 4])
            // ->join('posts', 'events.post_id', '=', 'posts.id')
            ->join('subreddits', 'customer_subreddits.subreddit_id', '=', 'subreddits.id')
            ->get();

            
        $arr2 = collect($result2)->map(function($v,$k){
            $e =  (object) [];
            $e->id = $v->subreddit_id;
            $e->name = $v->name ;
            return $e;
        });

        // $arr2 = collect($result2)->pluck('name', 'subreddit_id',);

        $arr3 = $arr->merge($arr2);

        return response()->json(['data' => $arr3, 'status' => true]);
    }
}
