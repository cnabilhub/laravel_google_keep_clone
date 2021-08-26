<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    // Category page 
    public function index()
    {
        //
        return view('categories.index');
    }
    // get categories by ajax for datatables 
    public function getCategories(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::where('user_id', '=', Auth::id())->latest()->get();
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
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        try {
            //Validation

            $request->validate([
                'name' => 'required|unique:categories|max:50',
                'desc' => 'max:50',
            ]);

            $dataTosend = Category::create([
                'name' => $request->name,
                'desc' => $request->desc,
                'user_id' => Auth::id(),
            ])->save();
            return response()->json([
                'message' => 'Category created ',
            ]);
        } catch (ValidationException $exception) {
            return response()->json([
                'errors' => $exception->errors(),
            ]);
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


    public function update(Request $request)
    {
        try {

            $category_exist = Category::findOrfail($request->id);

            if ($category_exist) {
                //  validate request   
                $request->validate([
                    'name' => 'required|max:50',
                    'desc' => 'max:191',
                ]);
                $category_exist->name = $request->name;
                $category_exist->desc = $request->desc;
                $category_exist->save();
            }

            return response()->json([
                'message' => 'Category Updated ',
            ]);
        } catch (ValidationException $exception) {

            return response()->json([
                'error' => $exception->errors(),
            ]);
        }
    }


    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            try {
                $category_exist = Category::findOrfail($request->id);
                if ($category_exist && $category_exist->user_id == Auth::id()) {
                    $category_exist->delete();
                    return response()->json([
                        'message' => 'Category Deleted ',
                    ]);
                } else {
                    return response()->json([
                        'error' => 'someting went wrong',
                    ]);
                }
            } catch (\Exception $e) {
                return response()->json([
                    'error' => $e->getMessage(),
                ]);
            }
        }
    }

    public function getCategory(Request $request)
    {
        if ($request->ajax()) {
            try {
                $category_exist = Category::findOrfail($request->id);
                if ($category_exist && $category_exist->user_id == Auth::id()) {
                    return response()->json([
                        'message' => [
                            'id' =>  $category_exist->id,
                            'name' =>  $category_exist->name,
                            'desc' =>  $category_exist->desc,
                        ]
                    ]);
                } else {
                    return response()->json([
                        'error' => 'someting went wrong',
                    ]);
                }
            } catch (\Exception $e) {
                return response()->json([
                    'error' => $e->getMessage(),
                ]);
            }
        }
    }
}