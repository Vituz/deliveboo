<?php

namespace App\Http\Controllers\Admin;
use App\Dish;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Providers\RouteServiceProvider;
use App\User;

class HomeController extends Controller
{


   
    protected $redirectTo = RouteServiceProvider::HOME;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        
        return view('admin.home',compact('user'));
    }



    /**
     * Set a profile image
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function setImage(Request $request)
    {
        /* ddd($request->all()); */
        $validated= $request->validate(['image'=>'nullable | image']);

        /* controllo presenza immagine nella request */
        if ($request->hasFile('image')) {
            $file_path=Storage::put('user_images',$validated['image']);
            $validated['image']=$file_path;
            $user = Auth::user();
            $user->update($validated);
            }

        return redirect()->route('admin.dashboard');
    }

    /**
     * change the profile image
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function changeImage(Request $request)
    {  
        
        $user_image = Auth::user()->image;
        $validated= $request->validate(['image'=>'nullable | image']);

        /* controllo presenza immagine nella request */
        if ($request->hasFile('image')) {
        Storage::delete($user_image);
        $file_path=Storage::put('user_images',$validated['image']);
        $validated['image']=$file_path;
        $user = Auth::user();
        $user->update($validated);
        }
       
       return redirect()->route('admin.dashboard');
        
       
        
    }

}
