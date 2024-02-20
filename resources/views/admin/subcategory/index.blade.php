<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
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
                            <div class="col-md-9">
                                <div class="card">
                                    <br>
                                    <div style="color: white;" class="card-header">Subcategory</div>
                                    <div class="card-body">
                                        <a href="{{ route('subcategories.create') }}" class="btn btn-success btn-sm" title="Add New Subcategory">
                                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                                        </a>
                                        <br/>
                                        <br/>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Name</th>
                                                        <th>Category</th>
                                                        <th>Picture</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($subcategories as $subcategory)
                                                    <tr>
                                                        <td>{{ $subcategory->id }}</td>
                                                        <td>{{ $subcategory->name }}</td>
                                                        <td>{{ $subcategory->category->name }}</td>
                                                        <td>
                                                            @if($subcategory->picture)
                                                            <img src="{{ asset('images/subcategories/' . $subcategory->picture) }}" alt="Subcategory Picture" width="50" height="50">
                                                            @else
                                                                No Picture
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('subcategories.show', $subcategory->id) }}" title="View Subcategory"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                                            <a href="{{ route('subcategories.edit', $subcategory->id) }}" title="Edit Subcategory"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                                            <form method="POST" action="{{ route('subcategories.destroy', $subcategory->id) }}" accept-charset="UTF-8" style="display:inline">
                                                                @method("DELETE")
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Subcategory" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
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
    @include('admin.script')
</body>
</html>
