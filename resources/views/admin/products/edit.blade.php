@extends('admin.layouts.app')
@section('content')
    <div class="page-body">
        <div class="title-header">
            <h5>edit Product</h5>
        </div>

        <!-- New Product Add Start -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">

                                <h5>Product Information</h5>
                            </div>
                            <div class="row">
                                <form action="{{ route('admin.products.update', $product->id) }}" method="POST"
                                    class="theme-form theme-form-2 mega-form" enctype="multipart/form-data">
                                    @method('put')
                                    @csrf
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-2 mb-0">Product
                                            Name</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="name"
                                                value={{ $product->name }}>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-2 col-form-label form-label-title">price</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="price"
                                                value={{ $product->price }}>
                                        </div>
                                    </div>



                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-2 col-form-label form-label-title">category</label>
                                        <div class="col-sm-10">
                                            <select class="js-example-basic-single w-100" name="category_id">
                                                <option disabled>Category Menu</option>
                                                @foreach ($category as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    {{-- <div class="mb-4 row align-items-center">
                                                        <label
                                                            class="col-sm-2 col-form-label form-label-title">Brand</label>
                                                        <div class="col-sm-10">
                                                            <select class="js-example-basic-single w-100">
                                                                <option disabled>Brand Menu</option>
                                                                <option value="puma">Puma</option>
                                                                <option value="hrx">HRX</option>
                                                                <option value="roadster">Roadster</option>
                                                                <option value="zara">Zara</option>
                                                            </select>
                                                        </div>
                                                    </div> --}}


                            </div>



                            <div class="card">
                                <div class="card-body">
                                    <div class="card-header-2">
                                        <h5>Description</h5>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <label class="form-label-title col-sm-2 mb-0">Product
                                                    Description</label>
                                                <div class="col-sm-10">
                                                    <div id="editor"></div>
                                                </div>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" name="content"
                                                        value={{ $product->content }}>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <div class="card-header-2">
                                        <h5>Product Images</h5>
                                    </div>

                                    <div class="row">
                                        <div class="mb-4 row align-items-center">
                                            <label class="col-sm-2 col-form-label form-label-title">Images</label>
                                            <div class="col-sm-10">
                                                <input class="form-control form-choose" type="text" name="image"
                                                    id="formFileMultiple" multiple value={{ $product->image }}>
                                            </div>
                                        </div>


                                    </div>
                                    <input type="submit" value="Thêm sản phẩm">

                                    </form>
                                </div>
                            </div>





                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- New Product Add End -->

        <!-- footer Start -->
        <div class="container-fluid">
            <footer class="footer">
                <div class="row">
                    <div class="col-md-12 footer-copyright text-center">
                        <p class="mb-0">Copyright 2021 © Voxo theme by pixelstrap</p>
                    </div>
                </div>
            </footer>
        </div>
        <!-- footer En -->
    </div>
@endsection
