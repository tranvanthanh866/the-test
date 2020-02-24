<?php
use Demo\Ecommerce\Http\Controllers\Admin\HelpersController;
?>
@extends('ecommerce::admin.template')
@section('content')
    <div class="container-fluid" id="category">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar"> {{ __('Categories')}}</h1>
        </div>
        @include('ecommerce::admin.parts.message')
        <div class="row">
            <div class="col-md-4 mb40">
                <div class="panel">
                    <div class="panel-title"> {{ __('Add Category')}}</div>
                    <div class="panel-body">
                        <form action="" method="post">
                            @csrf
                            @include('ecommerce::admin.category.form',['parents'=>$rows])
                            <div class="">
                                <button class="btn btn-primary" type="submit"> {{ __('Add new')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="filter-div d-flex justify-content-between ">
                    <div class="col-left">
                        @if(!empty($rows))
                            <span style="color: red">@{{ bulk_message }}</span>
                            <form method="post" action="{{url('admin/category/bulkedit')}}"
                                  class="filter-form filter-form-left d-flex justify-content-start"
                                  id="bulk-action">
                                {{csrf_field()}}
                                <select name="action" class="form-control">
                                    <option value="">{{__(" Bulk Action ")}}</option>
                                    <option value="delete">{{__(" Delete ")}}</option>
                                </select>
                                <button data-confirm="{{__("Do you want to delete?")}}"
                                        @click="bulkEdit"
                                        class="btn-info btn btn-icon dungdt-apply-form-btn"
                                        type="button">{{__('Apply')}}</button>
                            </form>


                        @endif
                    </div>
                    <div class="col-left">
                        <form method="get" action="{{url('/admin/category/')}} "
                              class="filter-form filter-form-right d-flex justify-content-end" role="search">
                            @csrf
                            <input type="text" name="s" value="{{ Request()->s }}" class="form-control">
                            <button class="btn-info btn btn-icon btn_search" id="search-submit"
                                    type="submit">{{__('Search Category')}}</button>
                        </form>
                    </div>
                </div>
                <div class="panel">
                    <div class="panel-body">
                        <form action="" class="bravo-form-item">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th width="60px"><input type="checkbox" class="check-all"></th>
                                    <th> {{ __('Name')}}</th>
                                    <th> {{ __('Slug')}}</th>
                                    <th class="d-none d-md-block"> {{ __('Date')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($rows) > 0)
                                    @foreach($rows as $category)
                                        {!! HelpersController::html_category($category) !!}
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">{{__("No data")}}</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script.body')
    <script>
        var category = new Vue ({
            el: '#category',
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
                        console.log($(this).is(":checked"));
                        if($(this).is(":checked")){
                            ids += '<input type="hidden" class="id_select" name="ids[]" value="'+$(this).val()+'">';
                        }
                    });
                    console.log(ids);
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
