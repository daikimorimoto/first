<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Travel;

class HomeController extends Controller
{
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
        // ここでplanデータを取得
        $plans = Plan::select('plans.*')
        ->where('user_id', '=', \Auth::id())
        ->whereNull('deleted_at')
        ->orderBy('updated_at', 'DESC')
        ->get();

        $travels = Travel::select('travel.*')
        ->where('user_id', '=', \Auth::id())
        ->whereNull('deleted_at')
        ->orderBy('updated_at', 'DESC')
        ->get();



        return view('create', compact('plans', 'travels'));
    }
    public function store(Request $request)
    {
        $posts = $request->all();
        $request->validate([ 'title' => 'required']);



        Plan::insert(['title' => $posts['title'],
                           'content' => $posts['content'],
                           'travel_title' => $posts['travel_title'],
                           'user_id' => \Auth::id()
                          ]);

        return redirect( route('home'));

    }

    public function travel(Request $request)
    {
        $posts = $request->all();
        $request->validate([ 'travel_title' => 'required']);

        Travel::insert(['title' => $posts['travel_title'],
                        'user_id' => \Auth::id()
                        ]);

        return redirect( route('home'));

    }

    public function edit($id)
    {
        // ここでplanデータを取得
        $plans = Plan::select('plans.*')
        ->where('user_id', '=', \Auth::id())
        ->whereNull('deleted_at')
        ->orderBy('updated_at', 'DESC')
        ->get();

        $edit_plan = Plan::find($id);

        $travels = Travel::select('travel.*')
        ->where('user_id', '=', \Auth::id())
        ->whereNull('deleted_at')
        ->orderBy('updated_at', 'DESC')
        ->get();

        return view('edit', compact('plans', 'edit_plan', 'travels'));
    }


    public function update(Request $request)
    {
        $posts = $request->all();
        $request->validate([ 'title' => 'required']);

        Plan::where('id', $posts['plan_id'])->update(['title' => $posts['title'],
                           'content' => $posts['content'],
                          ]);

        return redirect( route('home'));

    }
    public function destroy(Request $request)
    {
        $posts = $request->all();

        Plan::where('id', $posts['plan_id'])->update(['deleted_at' => date("Y-m-d H:i:s", time())]);

        return redirect( route('home'));

    }

    public function destroy_travel(Request $request)
    {
        $posts = $request->all();
        $request->validate([ 'travel_id' => 'required']);

        Travel::where('id', $posts['travel_id'])->update(['deleted_at' => date("Y-m-d H:i:s", time())]);

        return redirect( route('home'));

    }
}


