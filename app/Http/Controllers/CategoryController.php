<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('categories.index');
    }

    public function getCategories(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::where('user_id', '=', Auth::id())->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                    <div class="datatables-actions">
                    <a  href="javascript:void(0)" class="edit btn btn-success btn-sm">
                    <i class="fas fa-edit"></i></a> 
                    <a  href="javascript:void(0)" class="delete btn btn-danger btn-sm">
                    <i class="fas fa-trash"></i></a>
                    </div>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
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
            //Validation

            $request->validate([
                'name' => 'required|max:50',
                'desc' => 'max:50',
            ]);


            $dataTosend = Category::create([
                'name' => $request->name,
                'desc' => $request->desc,
                'user_id' => Auth::id(),
            ])->save();

            return redirect()->route('categories')->with(['message' => 'Category created succesfuly']);
        } catch (\Exception $e) {

            return redirect()->route('categories')->with(['error' => $e->getMessage()]);
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