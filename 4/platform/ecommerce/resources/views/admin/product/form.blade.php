<?php
use Demo\Ecommerce\Http\Controllers\Admin\HelpersController;
?>
<div class="form-group">
    <label>{{ __('Title')}}</label>
    <input type="text" value="{{ $row->product_name ?? 'Product new' }}" placeholder="News title" name="product_name" class="form-control">
</div>
<div class="form-group">
    <label>{{  __('Category')}} </label>
    <select name="category_id" class="form-control">
        <option value="">{{ __('-- Please Select --')}} </option>
        @foreach($rows as $category)
            {!! HelpersController::html_category_option($category) !!}
        @endforeach
    </select>
</div>
<div class="form-group">
    <label class="control-label">{{ __('Price')}} </label>
    <div class="">
        <input name="price" class="form-control" value="{{$row->price}}">
    </div>
</div>
<div class="form-group">
    <label class="control-label">{{ __('Description')}} </label>
    <div class="">
        <textarea name="description" class="form-control" cols="30" rows="3">{{$row->description}}</textarea>
    </div>
</div>
<div class="form-group">
    <label class="control-label">{{ __('Content')}} </label>
    <div class="">
        <textarea name="product_content" class="form-control" cols="30" rows="5">{{$row->product_content}}</textarea>
    </div>
</div>
