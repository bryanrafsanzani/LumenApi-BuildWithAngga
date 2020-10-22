<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(Request $request)
    {
        $product = Product::all();
        return response()->json([
            'msg'   =>  $product->count().' Data was Found',
            'data'  => $product
        ]);

    }

    public function create(Request $request)
    {
        $this->validate($request,[
            'name'  =>  'required|min:1|max:181',
            'harga'  =>  'required|numeric|between:1,999999999',
            'warna'  =>  'required|min:1|max:181',
            'deskripsi'  =>  'nullable|string',
        ]);
        $product = Product::create($request->all());

        return response()->json([
            'msg'   =>  "Success create new data",
            'data'  => $product
        ]);
    }

    public function show($id)
    {
        $product = Product::find($id);

        if($product){
            return response()->json([
                'msg'   =>  "data was found",
                'data'  => $product
            ]);
        }
        return response()->json([
            'msg'   =>  "Data was not found",
            'data'  => null
        ], 404);

    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'  =>  'required|min:1|max:181',
            'harga'  =>  'required|numeric|between:1,999999999',
            'warna'  =>  'required|min:1|max:181',
            'deskripsi'  =>  'nullable|string',
        ]);
        $product = Product::find($id);

        if($product){
            $product->fill($request->all());
            $product->save;

            return response()->json([
                'msg'   =>  "Data was Updated",
                'data'  => null
            ]);
        }

        return response()->json([
            'msg'   =>  "Data Not Found, Cannot Update data",
            'data'  => null
        ], 404);
    }

    public function delete($id)
    {
        $product = Product::find($id);

        if($product){
            $product->delete();
            return response()->json([
                'msg'   =>  "Data Succes Deleted!",
                'data'  => null
            ]);
        }

        return response()->json([
            'msg'   =>  "Data Not found Failed to deleted!",
            'data'  => null
        ], 404);

    }
}
