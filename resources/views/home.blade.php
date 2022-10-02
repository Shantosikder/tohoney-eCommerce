@extends('layouts.dashboard_master')

@section('home')
active
@endsection

@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <span class="breadcrumb-item active">Home</span>
        </nav>

        <div class="sl-pagebody">

            <div class="row row-sm">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Dashboard
                        </div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <h1>Welcome, {{ Auth::user()->name }}</h1>
                            <h2>Email: {{ Auth::user()->email }}</h2>
                            <h3>Create: {{ Auth::user()->created_at }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>User List</h4>
                            <h2>Total User:{{ $total_user }}</h2>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Serial No</th>
                                        <th>ID No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="text-center">{{ $users->firstItem() + $loop->index }}</td>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>

                                                <li> {{ $user->created_at->format('d/m/Y h:i:s A') }}</li>

                                                <li> {{ $user->created_at->diffForHumans() }}</li>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div><!-- row -->

        </div>
    </div>
@endsection
