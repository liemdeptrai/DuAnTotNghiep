<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function category()
    {
        $category = Category::all();
        return view('admin.categories.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add()
    {

        return view('admin.categories.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $category = Category::create($input);
        return redirect()->route('admin.categories.index')
            ->with('success', 'User has been created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->all();

        // Tìm người dùng theo ID, nếu không tìm thấy sẽ ném ra ngoại lệ ModelNotFoundException
        $category = Category::findOrFail($id);

        // Kiểm tra nếu trường password được điền và không rỗng

        // Cập nhật thông tin người dùng
        $category->update($input);
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::destroy($id);
        return redirect()->route('admin.categories.index');
    }
}
