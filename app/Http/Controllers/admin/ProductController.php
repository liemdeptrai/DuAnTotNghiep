<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Category;
use App\Models\admin\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function view()
    {
        $products = $this->product->latest()->paginate(5);
        return view('index', compact('products'));
    }

    public function index()
    {
        $product = Product::all();
        return view('admin.products.index', compact('product'));
    }

    public function add()
    {
        $category = Category::get(['id', 'name']);
        return view('admin.products.add', compact('category'));
    }

    public function product()
    {
        $product = Product::all();
        return view('admin.products.index', compact('product'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string',
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $input = $request->except('image'); 
        if ($request->hasFile('image')) {
            $images = [];

            foreach ($request->file('image') as $file) {
                $path = $file->store('products', 'public');
                $images[] = $path;
            }
            $input['image'] = json_encode($images); 
        }

        // Create the product
        $product = Product::create($input);

        return redirect()->route('admin.products.index')->with('success', 'Product has been created successfully!');
    }

    public function show($id) // Phương thức hiển thị chi tiết sản phẩm
    {
        // Tìm sản phẩm theo ID
        $product = Product::find($id);
        
        // Giải mã chuỗi JSON thành mảng
        $images = json_decode($product->image);
    
        // Lấy giỏ hàng từ session
        $cart = session()->get('cart', []);
    
        // Tính số lượng sản phẩm trong giỏ
        $cartItemCount = array_sum(array_column($cart, 'quantity'));
    
        // Tính tổng giá tiền
        $totalPrice = array_sum(array_map(function($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));
    
        // Trả về view với sản phẩm, ảnh, số lượng sản phẩm và tổng giá
        return view('user.products.detail', compact('product', 'images', 'cartItemCount', 'totalPrice'));
    }

    public function edit($id)
    {
        $category = Category::get(['id', 'name']);
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('category', 'product'));
    }

    public function update(Request $request, string $id)
    {
        $input = $request->all();

        // Tìm sản phẩm theo ID
        $product = Product::findOrFail($id);

        // Cập nhật thông tin sản phẩm
        $product->update($input);
        return redirect()->route('admin.products.index');
    }

    public function destroy(string $id)
    {
        $category = Product::destroy($id);
        return redirect()->route('admin.products.index');
    }

    public function layouts(string $id)
    {
        $product = Product::all();
        return redirect()->route('admin.products.index');
    }
}
