
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
        <div class="main-panel" style="align: center">
            <div class="content-wrapper">
                <div class="div_center">
@extends('admin.product.layout')

@section('content')

    <div class="container">
        @if(session()->has('message'))
<div class="alert alert-success">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
{{session()->get('message')}}
</div>
@endif
        <div class="row">
            <div class="col-md-9" style="width: 1200px;">
                <div class="card">
                    <div class="card-header">Products</div>
                    <div class="card-body">
                        <a href="{{ route('products.create') }}" class="btn btn-success btn-sm" title="Add New Product">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Picture</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>discount price</th>
                                        <th>availableqte</th>
                                        <th>Category</th>
                                        <th style="width: 180px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($product as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if($item->picture)
                                                <img src="{{ asset('storage/' . $item->picture) }}" alt="Product Image" style="max-width: 100px; max-height: 100px;">
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->discount_price }}</td>
                                        <td>{{ $item->available_qte }}</td>
                                        <td>
                                            @if($item->category && $item->category->icon)
                                                <img src="{{ asset('storage/' . $item->category->icon) }}" alt="Category Icon" class="img-fluid">
                                            @else
                                                No Category Icon
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('products.show', $item->id) }}" title="View product"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ route('products.edit', $item->id) }}" title="Edit product"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ route('products.destroy', $item->id) }}" accept-charset="UTF-8" style="display:inline">
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
@endsection
