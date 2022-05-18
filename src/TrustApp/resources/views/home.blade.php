@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Dashboard') }}</h1>

    @if (session('success'))
    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Main Balance</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{ Auth::user()->balance }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Available Credit</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{ Auth::user()->balance }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Expenditure Account</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">{{ __('Credit Used') }}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                            <!-- {{ $widget['user'] }} -->
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-6 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Transaction History</h6>
                </div>
                <div class="card-body">
                    <!-- <h4 class="small font-weight-bold">Server Migration <span class="float-right">20%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Sales Tracking <span class="float-right">40%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Customer Database <span class="float-right">60%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Payout Details <span class="float-right">80%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div> -->
                    <!-- <h4 class="small font-weight-bold">Account Setup <span class="float-right">Complete!</span></h4> -->
                    <div>
                        <!-- <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div> -->
                        @if(Auth::user()->transactions)

                        @foreach(Auth::user()->transactions()->OrderBy('created_at', 'desc')->take(4)->get() as $transaction)
                        {{$transaction->type}}
                        ${{$transaction->amount}}
                        {{$transaction->created_at->format('M j, Y, g:i a') }}
                        <hr>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <!-- Color System -->
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <a href="{{ route('transfer') }}" style="text-decoration: none;">
                    <div class="card bg-white text-white shadow">
                        <div class="card-body">
                         <div class="text-primary-50 small" style="color: blue;">Transfer</div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-6 mb-4">
                    <a href="{{ route('usecredit') }}" style="text-decoration: none;">
                    <div class="card bg-white text-white shadow">
                        <div class="card-body">
                            <div class="text-primary-50 small" style="color: blue;">Use Available Credit</div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-6 mb-4">
                <a href="{{ route('buyairtimedata') }}" style="text-decoration: none;">
                    <div class="card bg-white text-white shadow">
                        <div class="card-body">
                            <div class="text-primary-50 small" style="color: blue;">Buy Crypto</div>
                        </div>
                    </div>
                </a>
                </div>
                <div class="col-lg-6 mb-4">
                <a href="{{ route('paybills') }}" style="text-decoration: none;">
                    <div class="card bg-white text-white shadow">
                        <div class="card-body">
                            <div class="text-primary-50 small" style="color: blue;">Earn</div>
                        </div>
                    </div>
                </a>
                </div>
                <div class="col-lg-6 mb-4">
                <a href="{{ route('requestpayment') }}" style="text-decoration: none;">
                    <div class="card bg-white text-white shadow">
                        <div class="card-body">
                            <div class="text-primary-50 small" style="color: blue;">Request Payment</div>
                        </div>
                    </div>
                </a>
                </div>
                <div class="col-lg-6 mb-4">
                <a href="{{ route('makepayments') }}" style="text-decoration: none;">
                    <div class="card bg-white text-white shadow">
                        <div class="card-body">
                            <div class="text-primary-50 small" style="color: blue;">Make Payments</div>
                        </div>
                    </div>
                </a>
                </div>
            </div>

        </div>

        <div class="col-lg-6 mb-4">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">In App Transfer</h6>
                </div>
                <div class="card-body">
                    <!-- <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="{{ asset('img/svg/undraw_editable_dywm.svg') }}" alt="">
                    </div>
                    <p>Add some quality, svg illustrations to your project courtesy of <a target="_blank" rel="nofollow" href="https://undraw.co/">unDraw</a>, a constantly updated collection of beautiful svg images that you can use completely free and without attribution!</p>
                    <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on unDraw →</a> -->

                    <form class="col-sm-6" action="{{route('homeinapptransfer')}}" method="POST" class="user">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <input
                            type="text"
                            class="form-control form-control-user"
                            name="username"
                            placeholder="{{ __('Username') }}"
                            value="{{ old('username') }}" required autofocus
                        />
                    </div>
                    <div class="form-group">
                        <input
                            type="number"
                            class="form-control form-control-user"
                            name="amount"
                            placeholder="{{ __('Amount') }}"
                            value="{{ old('amount') }}" required
                        />
                    </div>

                    <div class="form-group">
                        <label for="Message">Purpose</label>
                        <textarea class="form-control" id="formControlTextareaClient" formControlName="Message" rows="3" name="Message"></textarea>
                    </div>
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            {{ __('Send') }}
                        </button>
                    </div>
                    </form>

                </div>
            </div>

            <!-- Approach -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Digital Debit Card</h6>
                </div>
                <div class="card-body">
                    <!-- <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce CSS bloat and poor page performance. Custom CSS classes are used to create custom components and custom utility classes.</p>
                    <p class="mb-0">Before working with this theme, you should become familiar with the Bootstrap framework, especially the utility classes.</p> -->
                    <div class="container-fluid bg-secondary vh-20 d-flex justify-content-center align-items-center">
                        <div class="card border-0 p-4 text-white" style="height: 260px; width: 390px; border-radius: 10px; background-color: #3A3A3A">
                            <div class="top_div text-white d-flex justify-content-between align-items-center"> <i class="bi bi-brightness-high fs-3"></i>
                                <div class="symbols d-flex align-items-center"> <i class="bi bi-wifi-2 fs-2 me-2 " style="transform: rotate(90deg);"></i> <img src="https://imgur.com/5mVCNBm.png" width=35> </div>
                            </div>
                            <div class="number mt-3 lh-1 " style="font-size: 10px;"> <span>Credit card number</span>
                                <div class="d-flex gap-2 mt-2">
                                    <p>2033</p>
                                    <p>2035</p>
                                    <p>6559</p>
                                    <p>5563</p>
                                </div>
                            </div>
                            <div class="name_exp d-flex justify-content-between mt-4" style="font-size: 10px;">
                                <div class="name"> <span>Name</span>
                                <p> <h5 class="font-weight-bold">{{  Auth::user()->fullName }}</h5></p>
                                </div>
                                <div class="expiry"> <span>Exp. Date</span>
                                <p>05/25</p>
                                </div> <img src="https://imgur.com/uNN72Zm.png">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
