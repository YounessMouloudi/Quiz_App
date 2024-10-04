<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $players = Player::with('score')->paginate(10);

        return view('admin.player.index',compact("players"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.player.add");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:players',
            'phone' => 'required|string|min:10|max:10',
            'image' => 'required|mimes:png,jpg,jpeg',
        ]);

        $image = $request->file('image')->getClientOriginalName();
        $request->image->move(public_path('images'),$image);

        $fields['image'] = $image;

        Player::create($fields);

        return redirect()->route('players.index')->with('message', 'player created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $player = Player::findOrFail($id);
        
        return view("admin.player.edit",compact("player"));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $fields = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:players,id',
            'phone' => 'required|string|min:10|max:10',
            'image' => 'required|mimes:png,jpg,jpeg',
        ]);

        $player = Player::findOrFail($id);

        $image = $request->file('image')->getClientOriginalName();
        $request->image->move(public_path('images'),$image);

        // dd($image);

        $fields['image'] = $image;

        $player->update($fields);

        return redirect()->route('players.index')->with('message', 'player updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Player::findOrFail($id)->delete();

        return redirect()->route('players.index')->with('message', 'player deleted successfully');

    }
}
