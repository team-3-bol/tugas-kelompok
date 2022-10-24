<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Product::TYPES;

        return view('product.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'description' => ['required'],
            'type' => ['required'],
            'stock' => ['required', 'integer'],
            'purchase_price' => ['required', 'integer'],
            'selling_price' => ['required', 'integer'],
            'image' => ['required', File::image()->max(2 * 2048)],
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file_name = date('YmdHis') . '_' . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
            $upload_dir = 'products';
            $file->move($upload_dir, $file_name);
        }

        $product = new Product();
        $this->save($request, $product, $file_name);

        session()->flash('success', 'The product created successfully.');
        return to_route('product.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $types = Product::TYPES;
        $product = Product::findOrFail($id);

        return view('product.edit', compact('types', 'product'));
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
        $request->validate([
            'name' => ['required'],
            'description' => ['required'],
            'type' => ['required'],
            'stock' => ['required', 'integer'],
            'purchase_price' => ['required', 'integer'],
            'selling_price' => ['required', 'integer'],
            'image' => [File::image()->max(2 * 2048)],
        ]);

        $product = Product::findOrFail($id);
        $upload_dir = 'products';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file_name = date('YmdHis') . '_' . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
            $file->move($upload_dir, $file_name);
        } else {
            $ext = \Illuminate\Support\Facades\File::extension(public_path($upload_dir . '/' . $product->file_name));
            $file_name = date('YmdHis') . '_' . Str::slug($request->name) . '.' . $ext;
            rename(
                public_path($upload_dir . '/' . $product->file_name),
                public_path($upload_dir . '/' . $file_name)
            );
        }

        $this->save($request, $product, $file_name);
        session()->flash('success', 'The product updated successfully.');
        return to_route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product_path = public_path('products/' . $product->image);

        if (file_exists($product_path)) {
            unlink($product_path);
        }

        $product->delete();
        session()->flash('success', 'The product deleted successfully.');
        return to_route('video.index');
    }

    /**
     * @param Request $request
     * @param $product
     * @param string $file_name
     * @return void
     */
    public function save(Request $request, $product, string $file_name): void
    {
        $product->name = $request->name;
        $product->description = $request->description;
        $product->type = $request->type;
        $product->stock = $request->stock;
        $product->purchase_price = $request->purchase_price;
        $product->selling_price = $request->selling_price;
        $product->image = $file_name;
        $product->save();
    }
}
