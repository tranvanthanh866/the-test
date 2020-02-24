@extends('ecommerce::admin.template')

@section('content')
    <form action="" method="post" class="dungdt-form">
        <div class="container-fluid">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar">{{$row->id ? 'Edit post: '.$row->title : 'Add new Product'}}</h1>
                </div>
            </div>
            @include('ecommerce::admin.parts.message')
            <div class="row">
                <div class="col-md-9">
                    <div class="panel">
                        <div class="panel-body">
                            @csrf
                            @include('ecommerce::admin.product.form',['parents'=>$rows, 'row'=>$row])
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel">
                        <div class="panel-title"><strong>Publish</strong></div>
                        <div class="panel-body">
                            <div>
                                <label><input @if($row->status=='publish') checked @endif type="radio" name="status" value="publish"> Publish
                                </label></div>
                            <div>
                                <label><input @if($row->status=='draft') checked @endif type="radio" name="status" value="draft"> Draft
                                </label></div>
                            <div class="text-right">
                                <button class="btn btn-primary" type="submit">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
