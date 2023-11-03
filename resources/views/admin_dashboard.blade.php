@extends('admin_master')

@section('admin_dynamic_1')
    <div class="container">
        <div class="row">
            <div class="col-4">
                <div class="card align-items-center">
                    <br>
                    <i class="fa-solid fa-users-line fa-5x" style="color: #fd0d25;""></i>
                    <div class="card-body">
                        <h4>Total Registered Users {{ $data['user_count'] }}</h4>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card align-items-center">
                    <br>
                    <i class="fa-solid fa-user-check fa-5x" style="color: #fd0d25;"></i>
                    <div class="card-body">
                        <h4>Total Active Users {{ $data['active_count'] }}</h4>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card align-items-center">
                    <br>
                    <i class="fa-solid fa-user-tag fa-5x" style="color: #fd0d25;"></i>
                    <div class="card-body">
                        <h4>Total Inactive Users {{ $data['inactive_count'] }}</h4>
                    </div>
                </div>
            </div>

        </div>
        <br><br>
        <div class="row">
            <div class="col-2 m-auto"></div>
            <div class="col-4 m-auto">
                <div class="card align-items-center">
                    <br>
                    <i class="fa-solid fa-user-xmark fa-5x" style="color: #fd0d25;"></i>
                    <div class="card-body">
                        <h4>Total Deleted Users {{ $data['deleted_count'] }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-4 m-auto">
                <div class="card align-items-center">
                    <br>
                    <i class="fa-regular fa-image fa-5x" style="color: #fd0d25;"></i>
                    <div class="card-body">
                        <h4>Total Events {{ $data['event_count'] }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-2 m-auto"></div>
        </div>
    </div>
    <br><br>
@endsection
