<?php

namespace App\Http\Controllers;

use App\Point;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PointController extends Controller
{
    public function SendGift(Request $request){
        $from = $request->from;
        $quantity = $request->quantity;
        $to = $request->to;

        Point::create([
            'from' => $from,
            'to' => $to,
            'quantity' => $quantity,
        ]);

        return response()->json([
           'message' => 'Success'
        ],200);
    }

    public function availableUsers($id){
        $users = User::where('id','!=',$id)->where('role','user')->orderby('id','desc')->with('points')->get();
//        $today = Carbon::now();
        foreach ($users as $user){
//            $sendToday = Point::where('from',$id)->where('to',$user->id)->whereDate('created_at',$today->format('Y-m-d'))->get();
//            if(count($sendToday) > 0){
//                $user->sendPoint = false;
//            }else{
//                $user->sendPoint = true;
//            }
            $this->checkUserGift($id,$user);
            $this->getUserPoints($id,$user);
        }
        return response()->json($users);
    }

    public function notifications($id){
        $points = Point::where('from','=',$id)->orWhere('to','=',$id)->orderby('id','desc')->with('from','to')->get();
        return response()->json($points);
    }

    public function adminNotifications($id){
        $points = Point::where('from','!=',$id)->orWhere('to','!=',$id)->orderby('id','desc')->with('from','to')->get();
        return response()->json($points);
    }

    public function checkUserGift($id,$user){
        $today = Carbon::now();
        $sendToday = Point::where('from',$id)->where('to',$user->id)->whereDate('created_at',$today->format('Y-m-d'))->get();
        if(count($sendToday) > 0){
            $user->sendPoint = false;
        }else{
            $user->sendPoint = true;
        }
        return $user;
    }

    public function getUserPoints($id,$user){

//        $userPoints = Point::where('from',$id)->where('to',$user->id)->whereDate('created_at',$today->format('Y-m-d'))->get();
//        if(count($sendToday) > 0){
//            $user->sendPoint = false;
//        }else{
//            $user->sendPoint = true;
//        }
        return $user;
    }
}
