<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Dish;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
       $user=Auth::user()->id;
       $dishes=Dish::where('user_id',$user)->get();
       return view('admin.dishes.index',compact('dishes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.dishes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request ->validate([
            'user_id' => 'required',
            'name' => 'required | max:50 | min:5',
            'type' => 'required',
            'description' => 'nullable',
            'ingredients' => 'nullable',
            'img' => 'nullable | mimes:jpeg,jpg,png| max: 5000',
            'price' => 'required | numeric',
            'visibility' => 'required | boolean'
        ]);

        Dish::create($validatedData);
        return redirect()->route('admin.dishes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Dish $dish)
    {
        return view('admin.dishes.show', compact('dish'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)
    {
        return view('admin.dishes.edit', compact('dish'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dish $dish)
    {
        $validatedData = $request ->validate([
            'user_id' => 'required',
            'name' => 'required | max:50 | min:5',
            'type' => 'required',
            'description' => 'nullable',
            'ingredients' => 'nullable',
            'img' => 'nullable | mimes:jpeg,jpg,png| max: 5000',
            'price' => 'required | numeric',
            'visibility' => 'required | boolean'
        ]);

        $dish->update($validatedData);
        return redirect()->route('admin.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {
        $dish->delete();
        return redirect()->route('admin.index');
    }
}
