<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Notification;
use App\Models\Product;
use App\Models\subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = request(['type', 'last-day', '7-days', 'last-month', 'last-year']);
        return view('Dashboard.product', [
            "products" => Product::with('category')->filter($requests)->latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Dashboard.product-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {

        //add notification to subscriber
        subscriber::sendNotification('add-product');

        $cleanData = $request->validated();

        $cleanData['photo'] = '/storage/' . $request->photo->store('/products');
        Product::create($cleanData);
        return redirect('/dashboard/products')->with('create', 'Created Successfully 🎉');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $ingredients = explode(',', $product->ingredients);
        $randomProducts = Product::with('category')->where(function ($query) use ($product) {
            $query->where('category_id', $product->category_id)->where('id', '!=', $product->id);
        })->inRandomOrder()->limit(5)->get();

        return view(
            'product.product-detail',
            [
                'product' => $product,
                'randomProducts' => cache()->remember('users', now()->addMinutes(5), function () use ($randomProducts) {
                    return $randomProducts;
                }),
                'ingredients' => $ingredients
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {

        return view(
            'Dashboard.product-edit',
            [
                'product' => $product,
                'categories' => Category::all()
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {


        subscriber::sendNotification('update-product');

        $cleanData = $request->validated();
        if ($request->photo) {

            if (File::exists($path = public_path($product->photo))) {
                File::delete($path);
            }
            $product->photo = '/storage/' . $request->photo->store('/products');
        }
        $product->title = $cleanData['title'];
        $product->description = $cleanData['description'];
        $product->price = $cleanData['price'];
        $product->category_id = $cleanData['category_id'];
        $product->stock = $cleanData['stock'];
        $product->is_publish = request()->is_publish ? true : false;
        $product->country_id = $cleanData['country_id'];
        $product->ingredients = $cleanData['ingredients'];

        $product->update();
        return redirect('/dashboard/products')->with('edit', 'Updated Successfully 🎉');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        subscriber::sendNotification('delete-product');

        $product->delete();
        return back()->with('delete', 'Delete Successfully! 🎆');
    }

    public function trash_products()
    {
        return view('Dashboard.product-trash', [
            'trash_products' => Product::onlyTrashed()->paginate(10)
        ]);
    }
}
