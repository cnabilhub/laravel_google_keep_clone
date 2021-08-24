<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;


class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tags = Tag::where('user_id', '=', Auth::id())->paginate(6);
        $data['tags']  = $tags;
        return view('tags.index')->with($data);
    }

    public function getTags(Request $request)
    {
        if ($request->ajax()) {
            $data = Tag::where('user_id', '=', Auth::id())->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                    <div class="datatables-actions">
                    <a  href="' . $row->id . '" class="edit btn btn-success btn-sm">
                    <i class="fas fa-edit"></i></a> 
                    <a  href="javascript:void(0)" class="delete btn btn-danger btn-sm">
                    <i class="fas fa-trash"></i></a>
                    </div>
                    ';
                    return $actionBtn;
                })
                ->editColumn('color', function (Tag $tag) {
                    return '<div class="p2  color" style="background-color: ' . $tag->color . '"></div>';
                })
                ->rawColumns(['action', 'color'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $data = $request->validate([
                'name' => 'required|max:50',
                'color' => 'required|max:1000',
            ]);
            $data['user_id'] = Auth::id();

            Tag::create($data)->save();
            return redirect()->route('tags')->with(['message' => 'Task created successful!']);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('tags')->with(['error' => $th->getMessage()]);
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