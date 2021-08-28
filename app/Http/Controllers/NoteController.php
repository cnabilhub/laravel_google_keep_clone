<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Note;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class NoteController extends Controller
{
    // showing all notes 

    public function index($cat = 0,Request $request)
    {

        $term = $request->term;
        // dd($request);
        // category filter

        if ($cat == 0) {

            // No category selected
            $data['notes'] = Note::where([

                ['title','LIKE','%'.$term.'%'],
                ['user_id', '=', Auth::id()],
                
                ])->orWhere('content','LIKE','%'.$term.'%')
                ->paginate(6);
        } else {
            // category selected

            $data['selected'] = $cat;
            $data['notes'] = Note::where([

                ['title','LIKE','%'.$term.'%'],
                ['title','LIKE','%'.$term.'%'],
                ['category_id', '=', $cat],
                ['user_id', '=', Auth::id()],

                ])->paginate(6);
        }
        // Append categories who have notes  in the filter
        $data['categories'] = Category::where('user_id', '=', Auth::id())->get();

        $data['term'] = $term;

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


        //Validation
        $data = $request->validate([
            'title' => 'bail|required|max:191',
            'content' => 'bail|required|max:10000',
            'category_id' => 'bail|integer',
        ], [
            'title.required' => 'Note title is required ',
            'title.max' => 'Note title cannot me more than :max caracter ',
            'title.required' => 'Note title is required ',
        ]);

        // Append authentificated user id 
        $data['user_id'] = Auth::id();
        // Create note
        $note = Note::create($data);
        $note->tags()->attach($request->tags);
        $note->save();


        return redirect()->route('notes.create')
            ->with('message', 'Note created Successfully 👍');
    }


    public function show($id)
    {
        //
        $note = Note::findOrFail($id);
        if ($note) {

            return view('notes.show')->with(['note' => $note]);
        } else {
            return view('notes.show')->with(['error' => 'No note found !!']);
        }
    }


    public function edit($id)
    {
        //find notes
        $note = Note::findOrFail($id);

        if ($note) {

            //Show all categories created by this user
            $categories = Category::where('user_id', '=', Auth::id())->get();

            //Show all tags created by this user
            $tags = Tag::where('user_id', '=', Auth::id())->get();

            $selectedTags = $note->tags->map(function ($tag) { return $tag->id;});
        
            // dd( $selectedTags);

                return view('notes.edit')->with([
                    'note' => $note, 
                    'categories' => $categories,
                    'tags' => $tags,
                    'selectedTags'=> $selectedTags->toArray()
                ]);


        } else {
            return view('notes.edit')->with(['error' => 'No note found !!']);
        }
    }

    public function update(Request $request, $id)
    {
                //Validation
        $data = $request->validate([
            'title' => 'bail|required|max:191',
            'content' => 'bail|required|max:10000',
            'category_id' => 'bail|integer',
        ], [
            'title.required' => 'Note title is required ',
            'title.max' => 'Note title cannot must more than :max caracter ',
            'title.required' => 'Note title is required ',
        ]);

        // check if note exist
        $note = Note::findOrFail($id);
        
        

        if($note){

                $oldTags = $note->tags;

            if($note->user_id == Auth::id()){

                $note->title = $request->title;
                $note->content = $request->content;
                $note->category_id = $request->category_id;
                $note->tags()->detach($oldTags);
                $note->tags()->attach($request->tags);
                $note->save();
                return redirect()->route('notes.edit',$id)
            ->with('message', 'Note Updated Successfully 👍');

            }else{
                   return redirect()->route('notes.edit',$id)
            ->with('error', 'You dont have rights to edit this note');
            }

        }else{
                  return redirect()->route('notes.edit',$id)
            ->with('error', 'This note is no longer be there');
        }
       
        
    }

    public function destroy(Request $request)
    {

        // check if note exist 
        $toDelete = Note::findOrfail($request->id);

        // check if this user is the ouner of this note
        if ($toDelete->user_id == Auth::id()) {
            $toDelete->delete();
        } else {

            return response()->json(['error' => 'You my not the owner of this note ']);
        }
        return response()->json(['message' => 'Note deleted successfuly !']);
    }
}