@extends('layouts.backend.app')

@section('title','Category')

@push('css')
@endpush

@section('content')

<div class="container-fluid">


    <!-- Vertical Layout | With Floating Label -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Edit New Category
                    </h2>
                </div>
                <div class="body">
                    <form action="{{ route('admin.category.update', $category->id) }}" method="POST">

                        <input type="hidden" name="_method" value="PUT">

                    	{{ csrf_field() }}

                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="name" class="form-control" name="name" value="{{ $category->name }}">
                                <label class="form-label">Category</label>
                            </div>
                        </div>

                       

                        <br>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">SAVE</button>
                        <a type="button" class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.category.index') }}">BACK</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Vertical Layout | With Floating Label -->
    
</div>

@endsection


@push('js')
@endpush
