<?php
use Demo\Ecommerce\Http\Controllers\Admin\HelpersController;
?>

<div class="form-group">
    <label> {{ __('Name')}}</label>
    <input type="text" value="{{$row->category_name}}" placeholder="Category name" name="category_name" class="form-control">
</div>
<div class="form-group">
    <label> {{ __('Parent')}}</label>
    <select name="parent_id" class="form-control">
        <option value=""> {{ __('-- Please Select --')}}</option>
        @foreach($rows as $category)
            {!! HelpersController::html_category_option($category) !!}
        @endforeach
    </select>
</div>
<div class="form-group">
    <label> {{ __('Slug')}}</label>
    <input type="text" value="{{$row->category_slug}}" placeholder="Category slug" name="category_slug" class="form-control">
</div>
<div class="form-group">
    <label class="control-label"> {{ __('Description')}}</label>
    <textarea name="description" class="form-control" cols="30" rows="5">{{$row->description}}</textarea>
</div>
