@extends('layouts.dashboard_master')

@section('category')
active
@endsection

@section('content')

<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
      <span class="breadcrumb-item active">Add Category</span>
    </nav>

    <div class="sl-pagebody">

      <div class="row row-sm">
        @if(session('update_status'))
        <div class="col-md-8">
       <div class="alert alert-success">
         {{ session('update_status') }}
       </div>
           </div>
       @endif

       @if(session('delete_status'))
        <div class="col-md-8">
       <div class="alert alert-warning">
         {{ session('delete_status') }}
       </div>
           </div>
       @endif

         <div class="col-md-8">
             <div class="card">
                 <div class="card-header">
                     <h3>List Category (Active)</h3>
                 </div>
                 <div class="card-body">
                     <table class="table table-bordered">

                         <thead>

                             <tr>
       <th>SL No</th>
       <th>Category Name</th>
       <th>Added By</th>
       <th>Created At</th>
       <th>Last Updated At</th>
       <th>Category Photo</th>
       <th>Action</th>
     </tr>
   </thead>
   <tbody>

    @foreach($categories as $category)
    <tr>
      <td>{{ $loop->index + 1 }}</td>
      <td>{{ $category->category_name  }}</td>
      <td>{{ App\User::find($category->user_id)->name }}</td>
      <td>

       @if($category->created_at)
       {{ $category->created_at->diffForHumans() }}
       @else
      <span class="bg-danger text-white"> No time to Show</span>
       @endif

     </td>

        <td>

       @if($category->updated_at)
       {{ $category->updated_at->diffForHumans() }}
       @else
      <span class="bg-danger text-white">No time to show</span>
       @endif

     </td>

     <td>
        <img src="{{ asset('uploads/category_photos') }}/{{ $category->category_photo}}" width="100" alt="Not Found">
     </td>

     <td>
       <div class="btn-group text-white" role="group" aria-label="Basic example">

       <a href="{{ url('update/category') }}/{{ $category->id }}" type="button" class="btn btn-info">Edit</a>
       <a href="{{ url('delete/category') }}/{{ $category->id }}" type="button" class="btn btn-danger">Delete</a>


      </div>
     </td>
    </tr>
    @endforeach

   </tbody>
 </table>
                 </div>
             </div>

             {{-- -----Restore And Hard delete table start---- --}}

             {{-- <div class="card mt-5">
                 <div class="card-header bg-danger text-white">
                     <h3>List Category (Deleted)</h3>
                 </div>
                 <div class="card-body">
                     <table class="table table-bordered">

                         <thead>

                             <tr>
       <th>SL No</th>
       <th>Category Name</th>
       <th>Added By</th>
       <th>Created At</th>
       <th>Last Updated At</th>
       <th>Action</th>
     </tr>
   </thead>
   <tbody>

    @foreach($categories as $category)
    <tr>
      <td>{{ $loop->index + 1 }}</td>
      <td>{{ $category->category_name  }}</td>
      <td>{{ App\User::find($category->user_id)->name }}</td>
      <td>

       @if($category->created_at)
       {{ $category->created_at->diffForHumans() }}
       @else
      <span class="bg-danger text-white"> No time to Show</span>
       @endif

     </td>

        <td>

       @if($category->updated_at)
       {{ $category->updated_at->diffForHumans() }}
       @else
      <span class="bg-danger text-white">No time to show</span>
       @endif

     </td>

     <td>
       <div class="btn-group text-white" role="group" aria-label="Basic example">

       <a href="{{ url('update/category') }}/{{ $category->id }}" type="button" class="btn btn-info">Restore</a>
       <a href="{{ url('delete/category') }}/{{ $category->id }}" type="button" class="btn btn-danger">Hard Delete</a>


      </div>
     </td>
    </tr>
    @endforeach

   </tbody>
 </table>
                 </div>
             </div> --}}

                   {{-- -----Restore And Hard delete table End---- --}}

         </div>

         <div class="col-md-4">
             <div class="card">
                 <div class="card-header">
                     <h3>Add Category</h3>
                 </div>
                 <div class="card-body">

           @if(session('success_message'))

           <div class="alert alert-success">

             {{session('success_message')}}

           </div>

           @endif

  <form action="{{url('add/category/post')}}" method="post" enctype="multipart/form-data">
 @csrf
   <div class="form-group">

     <label>Category Name</label>

     <input type="text" class="form-control" placeholder="Enter Category Name" name="category_name">

     @error('category_name')

     <span class="text-danger">{{$message}}</span>

     @enderror

   </div>

   {{-- -----categort photo------ --}}

   <div class="form-group">

     <label>Category Photo</label>

     <input type="file" class="form-control"  name="category_photo">

     @error('category_photo')

     <span class="text-danger">{{$message}}</span>

     @enderror

   </div>

   <button type="submit" class="btn btn-success">Add Category</button>

 </form>
                 </div>
             </div>
         </div>
      </div>
    </div>
</div>
@endsection
