<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Reminder;
use Mail;
use Sentinel;

class ForgotPasswordController extends Controller
{
    public function forgotpassword(){
        return view('authentication.forgot-password');
    }
    public function postForgotPassword(Request $request){
        $user = User::whereEmail($request->email)->first();
        $sentinelUser = Sentinel::findById($user->id);
        dd($sentinelUser);
       if($user->count() == 0)
        return redirect()->back()->with(['success'=>'Reset code was sent to your email']);
        Reminder::exists($sentinelUser) ?: Reminder::create($sentinelUser);
        $reminders=Reminder::all();
        foreach($reminders as  $reminder)
        if($reminder->user_id==$user->id)
        $usersreminder=$reminder->code;
        $this->sendEmail($user, $usersreminder);
        return redirect()->back()->with(['success'=>'Reset code was sent to your email']);
    }
    private function sendEmail($user, $code){
        Mail::send('emails.forgot-password-email', [ 
            'user'=>$user ,
            'code'=>$code
         ], function ($message) use ($user){
                 $message->to($user->email);
                $message->subject("Hello $user->first_name reset your password");
             });
    }
    public function resetPassword($email, $resetCode){
        $user=User::byEmail($email);
        if(count($user)==0)
        abort(404);
        $sentinelUser=Sentinel::findById($user->id);
        if(Reminder::exists($sentinelUser)){
            $reminders=Reminder::all();
            foreach($reminders as  $reminder)   
            if($reminder->user_id==$user->id){
            $usersreminder=$reminder->code;
            }
            if($resetCode==$usersreminder){
            Reminder::complete($sentinelUser, $resetCode, $request->password);
            return redirect('/login')->with('success', 'Please login with your new password');
            }
            else
            return redirect('/');
        }else{
            return redirect('/');
        }
        return $user;
    }
    public function postResetPassword(Request $request, $email, $resetCode){
        $this->validate($request, ['password' => 'confirmed|required|min:8|max:10',
        'passwordConfirmation' => 'required|min:5|max:10'
        ]);

        $user=User::byEmail($email);
        if(count($user)==0)
        abort(404);
        $sentinelUser=Sentinel::findById($user->id);
        if($reminder=Reminder::exists($sentinelUser)){
            $reminders=Reminder::all();
            foreach($reminders as  $reminder)
            if($reminder->user_id==$user->id){
            $usersreminder=$reminder->code;
            }
            if($resetCode==$usersreminder)
            return view(authentication.reset-password);
            else
            return redirect('/');
        }else{
            return redirect('/');
        }
        return $user;
    }
}

