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
        <div class="main-panel" style="align: center">
            <div class="content-wrapper">
                <div class="div_center">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="card">
                                    <div style="color: white;"="card-header">category</div>
                                    <div class="card-body">
                                        <a href="{{ route('categories.create') }}" class="btn btn-success btn-sm" title="Add New category">
                                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                                        </a>
                                        <br/>
                                        <br/>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>id</th>
                                                        <th>Name</th>
                                                        <th>Icon</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($category as $item)
                                                    <tr>
                                                        <td>{{ $item->id }}</td>
                                                        <td>{{ $item->name }}</td>
                                                        <td>
                                                            @if($item->icon)
                                                            <img src="{{ asset('storage/' . $item->icon) }}" alt="Category Icon" width="50" height="50">
                                                            @else
                                                                No Icon
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('categories.show', $item->id) }}" title="View category"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                                            <a href="{{ route('categories.edit', $item->id) }}" title="Edit category"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                                            <form method="POST" action="{{ route('categories.destroy', $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                                @method("DELETE")
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete category" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
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
