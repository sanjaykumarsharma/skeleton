@extends('layouts.backend.app')

@section('title','Settings')

@push('css')
@endpush

@section('content')
	
	<div class="container-fluid">
		<div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Settings
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);" class=" waves-effect waves-block">Action</a></li>
                                    <li><a href="javascript:void(0);" class=" waves-effect waves-block">Another action</a></li>
                                    <li><a href="javascript:void(0);" class=" waves-effect waves-block">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#update_profile" data-toggle="tab">
                                    <i class="material-icons">face</i> UPDATE PROFILE
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#profile_with_icon_title" data-toggle="tab">
                                    <i class="material-icons">change_history</i> CHANGE PASSWORD
                                </a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="update_profile">
                                <form action="{{ route('user.settings.profile-update') }}" method="POST" enctype="multipart/form-data">	
                                	<input type="hidden" name="_method" value="PUT">
    								{{ csrf_field() }}

	                                <div class="row clearfix">
	                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
	                                        <label for="email_address_2">Email Address</label>
	                                    </div>
	                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
	                                        <div class="form-group">
	                                            <div class="form-line">
	                                                <input type="text" id="email_address_2" class="form-control" placeholder="Enter your email address" name="email" value="{{ Auth::user()->email }}">
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>

	                                 <div class="row clearfix">
	                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
	                                        <label for="name">Name</label>
	                                    </div>
	                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
	                                        <div class="form-group">
	                                            <div class="form-line">
	                                                <input type="text" id="name" class="form-control" placeholder="Enter your Name" name="name" value="{{ Auth::user()->name }}">
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>

	                                <div class="row clearfix">
	                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
	                                        <label for="image">Profile Image</label>
	                                    </div>
	                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
	                                        <div class="form-group">
	                                            <div class="form-line">
	                                                <input type="file" id="image" class="form-control" name="image" value="{{ Auth::user()->name }}">
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>

	                                <div class="row clearfix">
	                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
	                                        <label for="about">About</label>
	                                    </div>
	                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
	                                        <div class="form-group">
	                                            <div class="form-line">
	                                                <textarea name="about" id="about" cols="30" rows="5" class="form-control">{{ Auth::user()->about }}</textarea>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>

	                                
	                                <div class="row clearfix">
	                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
	                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Update</button>
	                                    </div>
	                                </div>
	                            </form>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="profile_with_icon_title">
                                <form action="{{ route('user.settings.password-update') }}" method="POST" >	
                                	<input type="hidden" name="_method" value="PUT">
    								{{ csrf_field() }}

 	                                <div class="row clearfix">
	                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
	                                        <label for="old_password">Old Password</label>
	                                    </div>
	                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
	                                        <div class="form-group">
	                                            <div class="form-line">
	                                                <input type="password" id="old_password" class="form-control" placeholder="Enter your Old Password" name="old_password" >
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>

	                                <div class="row clearfix">
	                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
	                                        <label for="password">New Password</label>
	                                    </div>
	                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
	                                        <div class="form-group">
	                                            <div class="form-line">
	                                                <input type="password" id="password" class="form-control" placeholder="Enter your New Password" name="password" >
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>

	                                <div class="row clearfix">
	                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
	                                        <label for="password_confirmation">Confirm Password</label>
	                                    </div>
	                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
	                                        <div class="form-group">
	                                            <div class="form-line">
	                                                <input type="password" id="password_confirmation" class="form-control" placeholder="Enter your New Password Again" name="password_confirmation" >
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>

	                                
	                                <div class="row clearfix">
	                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
	                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Update</button>
	                                    </div>
	                                </div>
	                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>

@endsection


@push('js')
@endpush
