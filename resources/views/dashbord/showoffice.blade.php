@extends('dashbord.layout.navbar')

@section('content')

<div class="main-panel">
    <div class="content-wrapper">

<div class="card">
    <div class="card-body dashboard-tabs p-0">
        <ul class="nav nav-tabs px-4" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Report</a>
            </li>

        </ul>
        <div class="tab-content py-0 px-0">
            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                <div class="d-flex flex-wrap justify-content-xl-between">
                    <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                        {{-- <i class="mdi mdi-currency-usd mr-3 icon-lg text-danger"></i> --}}
                        <i class="mdi mdi-account-multiple mr-3 icon-lg text-danger"></i>

                            <div class="d-flex flex-column justify-content-around">
                                <small class="mb-1 text-muted">Report </small>
                                <h5 class="mr-2 mb-0"> {{ $office->name }} </h5>
                            </div>

                        </div>
                    <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                        <i class="mdi mdi-account-multiple mr-3 icon-lg text-info"></i>
                        <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">All Marketers</small>
                            <h5 class="mr-2 mb-0"> {{ $marketer }} </h5>
                        </div>
                    </div>
                    <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                        {{-- <i class="mdi mdi-download mr-3 icon-lg text-warning"></i> --}}
                        <i class="mdi mdi-account-card-details mr-3 icon-lg text-warning"></i>
                        <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">All Real State </small>
                            <h5 class="mr-2 mb-0"> {{ $real_state }} </h5>
                        </div>
                    </div>
                    <div class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                        <i class="mdi mdi-flag mr-3 icon-lg text-danger"></i>
                        <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">All Request</small>
                            <h5 class="mr-2 mb-0"> {{ $req }} </h5>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>









<div class="col-md-12 stretch-card mt-5">
    <div class="card">
<div class="card-body">
    <h1 class="text-center"> {{ $office->name }} </h1>
    <div class="row mt-3">
        <div class="col">
            <h4>Email</h4>
            <p class="">{{ $office->email }} </p>

        </div>
        <div class="col">
            <h4>Expired at</h4>
            <p class="text-muted">{{ $office->expired_at }} </p>

        </div>

    </div>

    <h4 class="mt-3">Created at</h4>
    <p class="text-muted">{{ $office->created_at->diffForHumans() }} </p>

    <div class="text-center">
    <h4 class="mt-4">Voucher</h4>
    <img src="https://halfapi.com/myapp/storage/app/public/{{ $office->voucher }} " alt="" width="500" height="500">
</div>

<div class="row">
    <div class="col-10">

    </div>
    <div class="col-2">
        <form action=" {{route('deleteoffice', ['id' => $office->id])}} " method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>

</div>
</div>
    </div>
</div>



















    </div>
</div>















@endsection('content')
