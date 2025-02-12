<?php

namespace App\Http\Controllers;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(){
        $request = Notification::all();
        return response()->json($request);
    }
}
