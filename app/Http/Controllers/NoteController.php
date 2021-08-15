<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Note;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($cat = null)
    {

        if ($cat == null) {
            $data['notes'] = Note::where('user_id', '=', Auth::id())->paginate(6);
        } else {

            $data['selected'] = $cat;
            $data['notes'] = Note::where('category_id', '=', $cat)->where('user_id', '=', Auth::id())->paginate(6);
        }

        $data['categories'] = Category::all();

        return view('notes.index', ['data' => $data]);

        // 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::where('user_id', '=', Auth::id())->get();
        $tags = Tag::where('user_id', '=', Auth::id())->get();
        return (view('notes.create', ['categories' => $categories, 'tags' => $tags]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {
            //Validation
            $data = $request->validate([
                'title' => 'required|max:50',
                'content' => 'required|max:1000',
                'category_id' => 'integer',
            ]);
            $data['user_id'] = Auth::id();
            $note = Note::create($data);
            $note->save();
            $note->tags()->attach($request->tags);

            return redirect()->route('notes.create')->with('message', 'Note created Successfully');
        } catch (\Exception $e) {

            return redirect()->route('notes.create')->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        try {
            # code...
            $deleted = Note::findOrfail($request->id)->delete();
            return redirect()->route('home')->with(['message' => 'Note deleted successfuly !']);
        } catch (\Throwable $e) {
            # code...

            return redirect()->route('home')->with(['error' => $e->getMessage()]);
        }
    }
}