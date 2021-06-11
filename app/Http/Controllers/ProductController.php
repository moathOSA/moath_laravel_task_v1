<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(array $attributes = array())
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('categories')->orderBy('updated_at', 'DESC')->paginate(10);
        return view('product.index', compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('product.create' , compact('categories'));

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
            'name'=>'required',
            'category' =>'required',
            'quantity' => 'nullable|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'price' => 'nullable|numeric|min:1|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/'
        ]);
        $imageName ='';
        if (!empty($request->image)){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }
        $product = Product::create(['name'=>$request->name , 'user_id' =>  auth()->user()->id , 'description' => $request->description , 'image' => $imageName  , 'quantity' => $request->quantity , 'price' => $request->price]);
        $product->categories()->attach($request->category);
        flash('Product Created')->success();
        return redirect()->to('/products');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product.show',compact('product'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $product_category = [];
        foreach($product->categories as $category){
            $product_category[] = $category->id;
        }
        return view('product.edit',['product' =>$product , 'categories' =>$categories , 'product_category' =>$product_category]);

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
            'name'=>'required',
            'category' =>'required',
            'quantity' => 'nullable|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'price' => 'nullable|numeric|min:1|regex:/^-?[0-9]+(?:\.[0-9]{1,3})?$/'
        ]);

        $product = Product::findOrFail($id);

        if (!empty($request->image)){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }else{
            $imageName = $product->image;
            if(isset($request->delete_image)){
                $imageName = '';
            }
        }

        $category_id = [];
        foreach ($product->categories as $category){
            $category_id [] = $category->id;
        }

        if ($request->category == $category_id)
            $is_sync_changed = false;
        else{
            $is_sync_changed = true;
        }
        $owner = $product->user->id;
        if ($product){
            $product->update(['name'=>$request->name , 'user_id' =>  $owner , 'description' => $request->description , 'image' => $imageName  , 'quantity' => $request->quantity , 'price' => $request->price]);
            $product->categories()->sync($request->category);
            }

        if ($product->wasChanged()|| $is_sync_changed) {
            flash('Product Updated')->success();
            return redirect()->to('/products');
        }else{
            flash('Nothing Changed')->error();
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function quantityPlus($id)
    {
        $product = Product::findOrFail($id);
        $product->update(['quantity' => $product->quantity+1]);
        if ($product->wasChanged()) {
            flash('Quantity Increased')->success();
            return redirect()->to('/products');
        }
    }
    public function quantityMinus($id)
    {
        $product = Product::findOrFail($id);
        if ($product->quantity == 1)
        {
            flash('Not This Time :)')->error();
            return redirect()->to('/products');
        }
        $product->update(['quantity' => $product->quantity-1]);
        if ($product->wasChanged()) {
            flash('Quantity Decreased')->success();
            return redirect()->to('/products');
        }
    }
    public function destroy($id)
    {
        Product::where('id',$id)->delete();
        flash('Product Deleted')->success();
        return redirect()->to('/products');
    }
}
