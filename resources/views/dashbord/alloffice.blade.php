@extends('dashbord.layout.navbar')

@section('content')



<div class="main-panel">
    <div class="content-wrapper">

        @if (session('deleteoffice'))
        <div class="card bg-gradient-primary border-0">
            <div class="card-body py-3 px-4 d-flex align-items-center justify-content-between flex-wrap">
                <p class="mb-0 text-white font-weight-medium"> {{ session('deleteoffice') }} </p>
                <div class="d-flex">

                </div>
            </div>
        </div>
        @endif
        @if (session('addoffice'))
        <div class="card bg-gradient-primary border-0">
            <div class="card-body py-3 px-4 d-flex align-items-center justify-content-between flex-wrap">
                <p class="mb-0 text-white font-weight-medium"> {{ session('addoffice') }} </p>
                <div class="d-flex">

                </div>
            </div>
        </div>
        @endif
        @if (session('status'))
        <div class="card bg-gradient-primary border-0">
            <div class="card-body py-3 px-4 d-flex align-items-center justify-content-between flex-wrap">
                <p class="mb-0 text-white font-weight-medium"> {{ session('status') }} </p>
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

                <p class="card-title col-2">List's Office Owner</p>

                <form action=" {{ route('search') }} " method="POST" class="col-8">
                    @csrf
                <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" aria-label="Recipient's username" name="search">
                        <div class="input-group-append">
                          <button class="btn btn-sm btn-primary" type="submit">Search</button>
                        </div>

                    </div>
                </form>

                <button  type="submit" class="btn btn-success col-2" data-toggle="modal" data-target="#exampleModal">New Office Owner</button>


                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Office Owner</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                       <div class="form-group">
                           <form method="POST" action=" {{ route('addoffice') }} " enctype="multipart/form-data">
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
                                                           <div class="form-group">
                                                            <label for="Description">Expired_at*</label>
                                                            <code>*Date will accept only this way (day/month/years)</code>
                                                            <input type="text" name="expired_at" class="form-control" id="Description" placeholder="dd/mm/yyyy" >
                                                                 </div>

                                <div class="form-group">
                         <label for="picture">Voucher</label>
                         <input type="file" name="voucher" class="form-control" id="picture" placeholder="image" >
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
                                <th>Status</th>
                                <th>Expired_at</th>
                                <th>Created at</th>
                                {{-- <th>Message</th>
                                <th>supprimé</th> --}}
                                <th>Change Status</th>


                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alloffice as $office)
                            <tr>
                            <td>{{ $office->name }}</td>
                                <td>
                                   @if (($office->is_active))

                                   <label class="badge badge-success">Active</label>

                                   @else
                                   <label class="badge badge-danger">In active</label>

                                   @endif
                                </td>
                                <td>{{ $office->expired_at }}</td>
                                <td>{{ $office->created_at->diffForHumans() }}</td>

                                 <td>
                                     <div class="row">

                                         <form method="POST" class="fm-inline"
                                         action=" {{ route('ChangeStatus', ['id' => $office->id]) }} ">
                                         @csrf
                                         @method('PUT')

                                         <input type="submit" value="Change Status!" class="btn btn-danger mr-2 btn-sm"/>

                                        </form>
                                        <a href=" {{ route('showoffice', ['id' => $office->id]) }} ">
                                            <button type="button" class="btn btn-primary btn-sm mdi mdi-eye">Show</button>
                                        </a>
                                    </div>
                                 </td>


                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{-- {!! $alloffice->links() !!} --}}
                        {!! $alloffice->appends(['sort' => 'department'])->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
    </div>

</div>



































@endsection('content')
