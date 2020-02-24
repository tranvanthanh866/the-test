<?php
use Demo\Ecommerce\Http\Controllers\Admin\HelpersController;
?>
@extends('ecommerce::admin.template')
@section('content')
    <div class="container-fluid" id="product">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{__("Products")}}</h1>
            <div class="title-actions">
                <a href="{{url('admin/product/create')}}" class="btn btn-primary">{{__("Add new Post")}}</a>
            </div>
        </div>
        @include('ecommerce::admin.parts.message')
        <div class="filter-div d-flex justify-content-between ">
            <div class="col-left">
                @if(!empty($rows))
                    <form method="post" action="{{url('admin/product/bulkedit')}}" id="bulk-action"
                          class="filter-form filter-form-left d-flex justify-content-start">
                        {{csrf_field()}}
                        <select name="action" class="form-control">
                            <option value="">{{__(" Bulk Actions ")}}</option>
                            <option value="publish">{{__(" Publish ")}}</option>
                            <option value="draft">{{__(" Move to Draft ")}}</option>
                            <option value="delete">{{__(" Delete ")}}</option>
                        </select>
                        <button data-confirm="{{__("Do you want to delete?")}}" class="btn-info btn btn-icon dungdt-apply-form-btn" type="submit">{{__('Apply')}}</button>
                    </form>
                @endif
            </div>
            <div class="col-left">
                <form method="get" action="{{url('/admin/product')}} " class="filter-form filter-form-right d-flex justify-content-end flex-column flex-sm-row" role="search">
                    <input type="text" name="s" value="{{ Request()->s }}" placeholder="{{__('Search by name')}}"
                           class="form-control">
                    <select name="cate_id" class="form-control">
                        <option value="">{{ __('--All Category --')}} </option>
                        @foreach($categories as $category)
                            {!! HelpersController::html_category_option($category) !!}
                        @endforeach

                    </select>
                    <button class="btn-info btn btn-icon btn_search" type="submit">{{__('Search News')}}</button>
                </form>
            </div>
        </div>
        <div class="text-right">
            <p><i>{{__('Found :total items',['total'=>$rows->total()])}}</i></p>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-body">
                        <form action="" class="bravo-form-item">
                            <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th width="60px"><input type="checkbox" class="check-all"></th>
                                    <th class="title"> {{ __('Product Name')}}</th>
                                    <th class="category"> {{ __('Category')}}</th>
                                    <th class="author"> {{ __('price')}}</th>
                                    <th class="date"> {{ __('Date')}}</th>
                                    <th width="100px">{{  __('Status')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($rows->total() > 0)
                                    @foreach($rows as $row)
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="check-item" name="ids[]" value="{{$row->product_id}}">
                                            </td>
                                            <td class="title">
                                                <a href="{{url('admin/product/edit/'.$row->product_id)}}">{{$row->product_name}}</a>
                                            </td>
                                            <td>{{$row->category->category_name ?? '' }}</td>
                                            <td> {{$row->price ?? ''}} </td>
                                            <td> {{ $row->updated_at}}</td>
                                            <td><span class="badge badge-{{ $row->status }}">{{ $row->status }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6">{{__("No data")}}</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                            </div>
                        </form>
                        {{$rows->appends(request()->query())->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script.body')
    <script>
        var category = new Vue ({
            el: '#product',
            data() {
                return {
                    bulk_message: '',
                }
            },
            methods: {
                bulkEdit() {
                    var _this = this;
                    _this.bulk_message = '';
                    var $form = $('#bulk-action');
                    $form.find('.id_select').remove();
                    var action = $form.find('[name=action]').val();
                    if(action == 'delete')
                    {
                        var c = confirm($form.find('button').data('confirm'));

                        if(!c){
                            return false;
                        }
                    } else {
                        _this.bulk_message = "Please select action"
                    }
                    let ids = '';
                    $(".bravo-form-item .check-item").each(function () {

                        if($(this).is(":checked")){
                            ids += '<input type="hidden" class="id_select" name="ids[]" value="'+$(this).val()+'">';
                        }
                    });

                    if(ids == '') {
                        _this.bulk_message = "Please select category.";
                    } else {
                        $form.append(ids);
                        $form.submit();
                    }

                }
            },
            created() {

            }
        })
    </script>
@endsection
