<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\ValidationException;

class TagController extends Controller
{
    // Tag page 
    public function index()
    {
        return view('tags.index');
    }

    // get Tags by ajax for datatables 
    public function getTags(Request $request)
    {
        // check if request by ajax
        if ($request->ajax()) {
            $data = Tag::where('user_id', '=', Auth::id())->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                    <div class="datatables-actions">
                      <button  onClick="edititem(' . $row->id . ');" value="' . $row->id . '" class="delete btn btn-success btn-sm">
                    <i class="fas fa-edit"></i>  <div class="d-none loading-action spinner-border spinner-border-sm" role="status"> <span class="sr-only"></span>
                    </div></button>

                     
                    <button  onClick="deleteitem(' . $row->id . ');" value="' . $row->id . '" class="delete btn btn-danger btn-sm">
                    <i class="fas fa-trash"></i>  <div class="d-none loading-action spinner-border spinner-border-sm" role="status"> <span class="sr-only"></span>
                    </div></button>
                    </div>
                    ';
                    return $actionBtn;
                })->editColumn('color', function (Tag $tag) {
                    return '<div class="p2  color" style="background-color: ' . $tag->color . '"></div>';
                })->rawColumns(['action', 'color'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|unique:Tags|max:50',
                'color' => 'max:50',
            ]);

            $dataTosend = Tag::create([
                'name' => $request->name,
                'color' => $request->color,
                'user_id' => Auth::id(),
            ])->save();

            if ($dataTosend) {
                return response()->json([
                    'message' => 'Tag created ',
                ]);
            } else {

                return response()->json([
                    'errors' => 'Error happend when saving Tag',
                ]);
            }
        } catch (ValidationException $exception) {
            return response()->json([
                'errors' => $exception->errors(),
            ]);
        }

    }


    public function update(Request $request)
    {

        try {

            $Tag_exist = Tag::findOrfail($request->id);

            if ($Tag_exist) {

                //  validate request   
                $request->validate([
                    'name' => 'required|max:50',
                    'color' => 'max:191',
                ]);
                $Tag_exist->name = $request->name;
                $Tag_exist->color = $request->color;
                $Tag_exist->save();

                return response()->json([
                    'message' => 'Tag Updated ',
                ]);
            } else {

                return response()->json([
                    'error' => 'This Tag dont exist !'
                ]);
            }
        } catch (ValidationException $exception) {

            return response()->json([
                'error' => $exception->errors(),
            ]);
        } 



    }


    public function destroy(Request $request)
    {
        if ($request->ajax()) {

            $Tag_exist = Tag::findOrfail($request->id);
            if ($Tag_exist && $Tag_exist->user_id == Auth::id()) {
                $Tag_exist->delete();
                return response()->json([
                    'message' => 'Tag Deleted ',
                ]);
            } else {
                return response()->json([
                    'error' => 'someting went wrong',
                ]);
            }
            if (!$Tag_exist) {

                return response()->json([
                    'error' => 'Tag not found',
                ]);
            }
        }
    }

    public function getTag(Request $request)
    {
        if ($request->ajax()) {

            $Tag_exist = Tag::findOrfail($request->id);
            if ($Tag_exist && $Tag_exist->user_id == Auth::id()) {
                return response()->json([
                    'message' => [
                        'id' =>  $Tag_exist->id,
                        'name' =>  $Tag_exist->name,
                        'color' =>  $Tag_exist->color,
                    ]
                ]);
            } else {
                return response()->json([
                    'error' => 'someting went wrong',
                ]);
            }

            if (!$Tag_exist) {
                return response()->json([
                    'error' => 'Tag not found',
                ]);
            }
        }
    }
}
