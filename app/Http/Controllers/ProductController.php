<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use DataTables;
class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('productAjax');
    }
    // public function store(Request $request)
    // {
    //     Product::updateOrCreate([
    //                 'id' => $request->product_id
    //             ],
    //             [
    //                 'name' => $request->name,
    //                 'detail' => $request->detail
    //             ]);
    //     return response()->json(['success'=>'Product saved successfully.']);
    // }
    public function store(Request $request)
        {
            Product::create([
                'name' => $request->name,
                'detail' => $request->detail
            ]);

            return response()->json(['success' => 'Product created successfully.']);
        }

        public function update(Request $request, $id)
        {
            $product = Product::find($id);
            $product->update([
                'name' => $request->name,
                'detail' => $request->detail
            ]);

            return response()->json(['success' => 'Product updated successfully.']);
        }


    public function edit($id)

    {
        $product = Product::find($id);
        return response()->json($product);

    }

    public function destroy($id)

    {

        Product::find($id)->delete();



        return response()->json(['success'=>'Product deleted successfully.']);

    }
}