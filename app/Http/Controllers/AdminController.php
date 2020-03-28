<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Course;
use App\Speakers;
use App\User;
use App\User_purchase_operations;
use App\Withdraws;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function Admin(){
        return view('admin');
    }
    public function AdminLogin(Request $request){

        $rules = [

        ];
        $messages =[

        ];
        $validator = $this->validator($request->all(),$rules,$messages);
        if ($validator->fails()){
            return back()->withErrors($validator->errors());
        }else{
            $admin = Admin::where('login',$request['login'])->first();

            if (isset($admin)){
                if ($admin['password'] == $request['password']){
                    session()->put('admin',$admin);
                    session()->save();
                    $data['sum'] = Course::pluck('bill')->sum();
                    $data['count'] = User::count();
                    $data['course_count']  = Course::count();
                    return view('admin.main',$data)->with('message','Вы вошли');
                }else{
                    return back()->withErrors('Ошибкаsds ');

                }

            }else{
                return back()->withErrors('Ошибкаsdsss ');
            }
        }
    }
    public function AdminMain(){

        $data['sum'] = Course::pluck('bill')->sum();
        $data['count'] = User::count();
        $data['course_count']  = Course::count();
        return view('admin.main',$data)->with('message','Вы вошли');
    }
    public function Applications(){
        $data['speakers'] = Speakers::where('status','wait')->paginate(12);


        return view('admin.application',$data);
    }
    public function Moderation(){
        $data['courses'] = Course::paginate(12);


        return view('admin.moderation',$data);
    }
    public function Users(){
        $data['users'] = User::paginate(12);


        return view('admin.users',$data);
    }
    public function Payments(){
        $data['payments'] =User_purchase_operations::join('courses','user_purchase_operations.course_id','=','courses.id')
            ->select('user_purchase_operations.*','courses.price')
            ->where('status','ok')
            ->paginate(12);
        return view('admin.payments',$data);
    }
    public function BusinessAccounts(){
        $data['speakers'] = Speakers::where('status','ok')->paginate(12);



        return view('admin.application',$data);

    }
    public function Withdraws(){
        $data['withdraws'] = Withdraws::where('status','wait')->paginate(12);
        return view('admin.withdraws',$data);
    }
    public function ApproveWithdraw($id){
        $withdraw = Withdraws::find($id);
        $course  = Course::find($withdraw['course_id']);
        $course['bill'] = $course['bill'] - $withdraw['amount'];
        $course->save();


        $withdraw['status'] = 'ok';
        $withdraw->save();


        return back()->with('message','Одобрено');
    }
    public function SpeakerApprove($id){
        $speaker = Speakers::find($id);
        $speaker['status'] = 'ok';
        $user = User::find($speaker['user_id']);
        $user['status'] = 'partner';
        $speaker->save();
        $user->save();


        return back()->with('message','Операция прошла успешно');

    }
}
