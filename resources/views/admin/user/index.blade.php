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
                            <div class="col-md-12">
                                <form action="{{ route('users.search') }}" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="text" name="search" class="form-control" placeholder="Search users" value="{{ request()->input('search') }}">

                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="submit">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-9">
                                <div class="card">
                                    <br>
                                    <div style="color: white;"="card-header">Clients</div>
                                    <div class="card-body">
                                        <br/>
                                        <br/>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>id</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Phone</th>
                                                        <th>Address</th>
                                                        <th>Email Verification</th>
                                                        <th>profile photo</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($users as $item)
                                                    <tr>
                                                        <td>{{ $item->id }}</td>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->email }}</td>
                                                        <td>{{ $item->phone }}</td>
                                                        <td>{{ $item->address }}</td>
                                                        <td>{{ $item->email_verified_at }}</td>
                                                        <td>
                                                            @if($item->profile_photo_path)
                                                            <img src="{{ asset('storage/' . $item->profile_photo_path) }}" alt="client Icon" width="50" height="50">
                                                            @else
                                                                No Icon
                                                            @endif
                                                        </td>
                                                        <td>

                                                            <a href="{{ route('user.edit', $item->id) }}" title="Edit client"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                                            <form method="POST" action="{{ route('user.destroy', $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                                @method("DELETE")
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete client" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
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
