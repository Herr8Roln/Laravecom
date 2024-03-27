<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
    <style type="text/css">
        .div_center {
            text-align: center;
            padding-top: 40px;
        }

        .h2_font {
            font-size: 40px;
            padding-bottom: 40px;
        }
    </style>
</head>
<body>
    <div class="container-scroller">
        @include('admin.sidebar')
        @include('admin.header')
        @if(session()->has('message'))
        <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        {{session()->get('message')}}
        </div>
        @endif
        <div class="main-panel" style="align: center">
            <div class="content-wrapper">
                <div class="div_center">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">Products</div>
                                    <div class="row justify-content-center">
                                        <div class="col-md-6">
                                            <form id="products.search" method="GET">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="searchInput" name="search" placeholder="Search For Something" aria-label="Search" aria-describedby="button-addon2">
                                                    <button type="submit" class="btn btn-outline-primary" id="searchButton">Search</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <a href="{{ route('products.create') }}" class="btn btn-success btn-sm" title="Add New Product">
                                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                                        </a>
                                        <br/>
                                        <br/>
                                        <div class="table-responsive">
                                            <table id="productTable" class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Picture</th>
                                                        <th>Name</th>
                                                        <th>Description</th>
                                                        <th>Price</th>
                                                        <th>Discount Price</th>
                                                        <th>Available Quantity</th>
                                                        <th>Category</th>
                                                        <th>Subcategory</th>
                                                        <th style="width: 180px">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($product as $product)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            @if($product->picture)
                                                            <img src="{{ asset('storage/' . $product->picture) }}" alt="Product Image" style="max-width: 100px; max-height: 100px;">
                                                            @else
                                                            No Image
                                                            @endif
                                                        </td>
                                                        <td>{{ $product->name }}</td>
                                                        <td>{{ $product->description }}</td>
                                                        <td>{{ $product->price }}</td>
                                                        <td>{{ $product->discount_price }}</td>
                                                        <td>{{ $product->available_qte }}</td>
                                                        <td>
                                                            @if($product->subcategory && $product->subcategory->category && $product->subcategory->category->icon)
                                                            <img src="{{ asset('storage/' . $product->subcategory->category->icon) }}" alt="Category Icon" class="img-fluid">
                                                            @else
                                                            No Category Icon
                                                            @endif

                                                        </td>
                                                        <td>
                                                            @if($product->subcategory && $product->subcategory->picture)
                                                            <img src="{{ asset('storage/subcategories/' . $product->subcategory->picture) }}" alt="Subcategory Picture" class="img-fluid">
                                                            @else
                                                            No Subcategory Picture
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('products.show', $product->id) }}" title="View product"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                                            <a href="{{ route('products.edit', $product->id) }}" title="Edit product"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                                            <form method="POST" action="{{ route('products.destroy', $product->id) }}" accept-charset="UTF-8" style="display:inline">
                                                                @method("DELETE")
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete product" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
