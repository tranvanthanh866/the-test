<?php
$menus = [
   /* [
        'url'   => 'admin',
        'title' => __("Dashboard"),
        'icon'  => 'icon ion-ios-desktop',
        "position"=>0
    ],*/
    [
        "position"=>2,
        'url'        => 'admin/category',
        'title'      => 'Category',
        'icon'       => 'ion-md-bookmarks',

    ],
    [
        "position"=>3,
        'url'        => 'admin/product',
        'title'      => 'Product',
        'icon'       => 'ion-md-bookmarks',

    ],

];


?>
<ul class="main-menu">
    @foreach($menus as $menuItem)

        <li class=""><a href="{{ url($menuItem['url']) }}">

                @if(!empty($menuItem['icon']))
                    <span class="icon text-center"><i class="{{$menuItem['icon']}}"></i></span>
                @endif
                {{$menuItem['title']}}
            </a>

            @if(!empty($menuItem['children']))
                <span class="btn-toggle"><i class="fa fa-angle-left pull-right"></i></span>
                <ul class="children">
                    @foreach($menuItem['children'] as $menuItem2)
                        <li class=""><a href="{{ url($menuItem2['url']) }}">
                                @if(!empty($menuItem2['icon']))
                                    <i class="{{$menuItem2['icon']}}"></i>
                                @endif
                                {{$menuItem2['title']}}</a></li>
                    @endforeach
                </ul>
            @endif

        </li>

    @endforeach
</ul>
