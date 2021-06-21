@extends('dashbord.layout.navbar')

@section('content')



<div class="main-panel">
    <div class="content-wrapper">
        @if (session('addadmin'))
        <div class="card bg-gradient-primary border-0">
            <div class="card-body py-3 px-4 d-flex align-items-center justify-content-between flex-wrap">
                <p class="mb-0 text-white font-weight-medium"> {{ session('addadmin') }} </p>
                <div class="d-flex">

                </div>
            </div>
        </div>
        @endif
        @if (session('deleteadmin'))
        <div class="card bg-gradient-primary border-0">
            <div class="card-body py-3 px-4 d-flex align-items-center justify-content-between flex-wrap">
                <p class="mb-0 text-white font-weight-medium"> {{ session('deleteadmin') }} </p>
                <div class="d-flex">

                </div>
            </div>
        </div>
        @endif


<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">

                <p class="card-title col-10">List's Admin</p>
                <button  type="submit" class="btn btn-success col-2" data-toggle="modal" data-target="#exampleModal">New Admin</button>

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                       <div class="form-group">
                           <form method="POST" action=" {{ route('addadmin') }} " >
                                @csrf

                                <div class="form-group">
                                    <label for="title">Name</label>
                                    <input type="text" name="name" class="form-control" id="title" placeholder="Name" >
                                           </div>

                                           <div class="form-group">
                                            <label for="Description">Email</label>
                                            <input type="text" name="email" class="form-control" id="Description" placeholder="email" >
                                                   </div>
                                                   <div class="form-group">
                                                    <label for="Description">Password</label>
                                                    <input type="password" name="password" class="form-control" id="Description" placeholder="password" >
                                                           </div>



                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" >Save changes</button>
                    </form>

                     </div>

                    </div>
                    </div>
                    </div>
                </div>
                </div>
                @if($errors->any())
                <div>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li class="text-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <div class="table-responsive">
                    <table id="" class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Created at</th>
                                <th>Delete</th>


                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alladmin as $office)
                            <tr>
                            <td>{{ $office->name }}</td>
                                <td>
                                  {{ $office->email }}
                                </td>
                                <td>{{ $office->created_at->diffForHumans() }}</td>
                                @if (Auth::user()->id != $office->id)

                                <td>
                                    <form action="{{ route('deleteadmin', ['id' => $office->id]) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger  ">Delete</button>
                                    </form>
                                </td>

                                @endif

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








































@endsection('content')
