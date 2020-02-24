<?php
namespace Demo\Ecommerce\Http\Controllers\Front;

use Demo\Ecommerce\Http\Controllers\Admin\HelpersController;
use Illuminate\Http\Request;
use Demo\Ecommerce\Models\Product;
use Demo\Ecommerce\Models\Category;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    function __construct(){}

    public function index (Request $request) {
        $catlist = new Category;
        $products = new Product;
        $catename = '';
        if ($catename = $request->query('s')) {
            $list = collect(\DB::select($catlist->query_build($catename)));
            $categories = HelpersController::build_tree($list);
            $cat_get_product = collect(\DB::select($catlist->query_get_child_cate($catename)));
            $ids_cat = $cat_get_product->pluck('category_id');
            $products = $products->whereIn('category_id', $ids_cat)->orderBy('created_at', 'asc')
                        ->paginate(10);
        } else {
            $categories = HelpersController::build_tree($catlist->get());
            $products = $products->orderBy('created_at', 'asc')->paginate(10);;
        }

        $data = [
            'categories' => $categories,
            'products' => $products
        ];
        return view('ecommerce::front.index',$data);
    }

}
