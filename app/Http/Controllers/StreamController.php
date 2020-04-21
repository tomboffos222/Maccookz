<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Redis;

class StreamController extends Controller
{

    public function stream($id = null) {
        // var_dump(Redis::get('test'));
        $user = session()->get('user');
        $data['user'] =  User::find($user['id']);
        $data['course'] = DB::table('courses')->where('user_id', $user['id'])->where('id', $id)->first();
        return view('stream', $data);
    }

    public function viewStream($id = null) {
        $user = session()->get('user');
        $data['user'] =  User::find($user['id']);
        $data['courseId'] = $id;
        return view('view_stream', $data);
    }

}
