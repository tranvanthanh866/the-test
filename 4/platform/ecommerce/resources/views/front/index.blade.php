@php
    function echo_category ($category, $prefix = '') {
        $html = '
            <a href="javascript:voi(0)" class="list-group-item">'.$prefix.$category->category_name.'</a>
        ';
        if (count($category->children) > 0) {
            $prefix = $prefix.' - ';
            foreach ($category->children as $child) {
                $html .= echo_category_children($child, $prefix);
            }
        }
        return $html;
    }
    function echo_category_children ($category, $prefix) {
        $html = '
            <a href="javascript:voi(0)" class="list-group-item">'.$prefix.$category->category_name.'</a>
        ';
        if (count($category->children) > 0) {
            $prefix = $prefix.' - ';
            foreach ($category->children as $child) {
                $html .= echo_category_children($child, $prefix);
            }
        }
        return $html;
    }
@endphp

@extends('ecommerce::front.template')
<!-- Page Content -->
<div class="container">

    <div class="row">

        <div class="col-lg-3">

            <h1 class="my-4">Shop Name</h1>
            <form class="form-search mb-2" style="display: flex">
                <input type="text" name="s"  style="width: 75%;" value="{{ Request()->s }}">
                <button style="width: 25%;">search</button>
            </form>
            <div class="list-group">
                @foreach($categories as $category)
                    @php echo echo_category($category, '') @endphp
                @endforeach
            </div>

        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">
            <div class="row my-4">
                @if($products->total() > 0)
                    @foreach($products as $product)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100">
                                <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a href="#">{{$product->product_name}}</a>
                                    </h4>
                                    <h5>$24.99</h5>
                                    <p class="card-text">{{$product->product_content}}</p>
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                                </div>
                            </div>
                        </div>

                    @endforeach
                @else
                    <div>
                        {{__("No data")}}
                    </div>
                @endif
                    {{$products->appends(request()->query())->links()}}

            </div>
            <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->
