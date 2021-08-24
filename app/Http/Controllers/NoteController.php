<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Note;
use App\Models\Category;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    // showing all notes 

    public function index($cat = 0)
    {

        // category filter

        if ($cat == 0) {

            // No category selected
            $data['notes'] = Note::where('user_id', '=', Auth::id())->latest()->paginate(6);
        } else {
            // category selected

            $data['selected'] = $cat;
            $data['notes'] = Note::where('category_id', '=', $cat)->where('user_id', '=', Auth::id())->paginate(6);
        }
        // Append categories who have notes  in the filter
        $data['categories'] = Category::where('user_id', '=', Auth::id())->get();

        return view('notes.index', ['data' => $data]);
    }

    //  Create note Form 
    public function create()
    {
        //Show all categories created by this user
        $categories = Category::where('user_id', '=', Auth::id())->get();

        //Show all tags created by this user
        $tags = Tag::where('user_id', '=', Auth::id())->get();

        return (view('notes.create', ['categories' => $categories, 'tags' => $tags]));
    }

    // Store New note
    public function store(Request $request)
    {

        try {


            //Validation
            $data = $request->validate([
                'title' => 'required|max:191',
                'content' => 'required|max:1000',
                'category_id' => 'integer',
            ], [
                'title.required' => 'Note title is required ',
                'title.max' => 'Note title cannot me more than :max caracter ',
                'title.required' => 'Note title is required ',
            ]);

            // Append authentificated user id 
            $data['user_id'] = Auth::id();

            $note = Note::create($data);
            $note->tags()->attach($request->tags);
            $note->save();

            return redirect()->route('notes.create')->with('message', 'Note created Successfully 👍');
        } catch (\Exception $e) {

            return redirect()->route('notes.create')->with('error', $e->getMessage());
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Request $request)
    {
        try {
            $toDelete = Note::findOrfail($request->id);
            if ($toDelete->user_id == Auth::id()) {
                $toDelete->delete();
            } else {
                throw new Error('sometings went wroooong');
            }
            return redirect()->route('home')->with(['message' => 'Note deleted successfuly !']);
        } catch (\Throwable $e) {

            return redirect()->route('home')->with(['error' => $e->getMessage()]);
        }
    }
}