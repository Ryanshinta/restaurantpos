<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','store']]);
        $this->middleware('permission:product-create', ['only' => ['create','store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = new Product();
        if ($request->search) {
            $products = $products->where('name', 'LIKE', "%{$request->search}%");
        }
        $products = Product::all();

        return view('product.index')->with('products', $products);
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(ProductStoreRequest $request)
    {
        $imagePath = '';

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagePath,
            'price' => $request->price,
            'status' => $request->status
        ]);


        if (!$product) {
            return redirect()->back()->with('error', 'Sorry, there a problem while creating product');
        }

        $this->generateXML();
        return redirect()->route('product.index')->with('success', 'Success, you product have been created.');


    }

    public function generateXML(){
        $XMLpath = 'public/xml/ProductInfo.xml';
        if (file_exists($XMLpath)){
            unlink($XMLpath);
        }else{
            $results = Product::all();
            $xml = new \DOMDocument('1.0');
            $xml->formatOutput = true;
            $products = $xml->createElement('Products');
            $xml->appendChild($products);
            foreach ($results as $row){
                $product = $xml->createElement('Product');
                $products->appendChild($product);

                $ID = $xml->createElement('ID',$row['id']);
                $product->appendChild($ID);

                $Status = $xml->createAttribute('Status');
                $product->setAttribute('Status',$row['status']);

                $name = $xml->createElement('name',$row['name']);
                $product->appendChild($name);

                $description = $xml->createElement('description',$row['description']);
                $product->appendChild($description);

                $price = $xml->createElement('price',$row['price']);
                $product->appendChild($price);

                $createdAt = $xml->createElement('createdAt',$row['created_at']);
                $product->appendChild($createdAt);

                $updatedAt = $xml->createElement('updatedAt',$row['updated_at']);
                $product->appendChild($updatedAt);

                $imagePath = $xml->createElement('imagePath',"/storage/".$row['image']);
                $product->appendChild($imagePath);
            }
            echo "<xmp>" . $xml->saveXML() . "</xmp>";
            $xml->save("xml/ProductInfo.xml") or die("Unable to create xml");
        }
    }

    public function edit(Product $product)
    {
        return view('product.edit')->with('product', $product);
    }


    public function update(ProductUpdateRequest $request, Product $product)
    {
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->status = $request->status;

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::delete($product->image);
            }

            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        if (!$product->save()) {
            return redirect()->back()->with('error', 'Sorry, there\'re a problem while updating product.');
        }
        $this->generateXML();
        return redirect()->route('product.index')->with('success', 'Success, your product have been updated.');

    }


    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::delete($product->image);
        }
        $product->delete();
        $this->generateXML();
        return redirect('product')->with('success', "Success, your product have been delete.");
    }

    public function search(){

    }
}
