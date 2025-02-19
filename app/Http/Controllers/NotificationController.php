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
    public function update(Request $request, string $id)
    {
        $requestion = Notification::find($id);
    
        $requestion->status = 'visualizado'; 
        $requestion->save();
        
        return response()->json([
            'message' => 'Notificação atualizada com sucesso',
            'movement' => $requestion
        ], 200);
    }

}