<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function room_add(){
        if(!Auth::user()){
            return redirect()->route("dashboard");
        }
        if(Auth::user()->role !== "admin"){
            return redirect()->route("dashboard");
        }
        return view("room_create");
    }
    public function room_addform(RoomRequest $request){
        if(Auth::user()->role !== "admin"){
            return redirect()->route("dashboard");
        }
        $room = new Room();
        $room -> name = $request->name;
        $room -> description = $request->description;
        if($request->hasFile('image')){
            $room -> image = time() . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('storage/rooms'), $room->image);
        }
        $room->save();
        // return back();
        return redirect()->route("dashboard");
    }
    public function room_delete(Room $room){
        if(Auth::user()->role !== "admin"){
            return redirect()->route("dashboard");
        }
        $room -> name = "зал удален";
        $room->save();
        // return back();
        return redirect()->route("dashboard");
    }
    public function room_edit(Room $room){
        if(Auth::user()->role !== "admin"){
            return redirect()->route("dashboard");
        }
        return view("room_edit", compact("room"));
    }
    public function room_editform(RoomRequest $request, Room $room){
        if(Auth::user()->role !== "admin"){
            return redirect()->route("dashboard");
        }
        $room -> name = $request->name;
        $room -> description = $request->description;
        if($request->hasFile('image')){
            $room -> image = time() . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('storage/rooms'), $room->image);
        } elseif ($request->input('old_image')) {
            $room -> image = $request->input('old_image');
        }
        $room->save();
        // return back();
        return redirect()->route("dashboard");
    }
}
