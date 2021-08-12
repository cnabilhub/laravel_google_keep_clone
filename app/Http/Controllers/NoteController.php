<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Note;
use App\Models\Category;
use Illuminate\Http\Request;

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
            $data['notes'] = Note::paginate(6);
        } else {

            $data['selected'] = $cat;
            $data['notes'] = Note::all()->where('category_id', '=', $cat);
        }

        $data['categories'] = Category::all();

        return view('home', ['data' => $data]);

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
        $categories = Category::all();
        $tags = Tag::all();
        return (view('create_note', ['categories' => $categories, 'tags' => $tags]));
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
                'category_id' => 'required|integer',
                'tag_id' => 'required|integer'
            ]);
            Note::create($data)->save();

            $request->session()->flash('success', 'Task was successful!');
            return redirect(route('create_note'));
        } catch (\Exception $e) {

            $request->session()->flash('error', $e->getMessage());
            return redirect(route('create_note'));
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
    public function destroy($id)
    {
        //
    }
}