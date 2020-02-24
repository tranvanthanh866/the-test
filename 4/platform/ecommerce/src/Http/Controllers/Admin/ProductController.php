<?php
namespace Demo\Ecommerce\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Demo\Ecommerce\Models\Product;
use Demo\Ecommerce\Models\Category;
use App\Http\Controllers\Controller;


class ProductController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $dataProducts = new Product;
        $product_name = $request->query('s');
        $cate = $request->query('cate_id');
        if ($cate) {
            $dataProducts = $dataProducts->where('category_id', $cate);
        }
        if ($product_name) {
            $dataProducts = $dataProducts->where('product_name', 'LIKE', '%' . $product_name . '%');
        }
        $dataProduct = $dataProducts->orderBy('created_at', 'asc');
        $data = [
            'rows'        => $dataProduct->paginate(10),
            'categories'  => HelpersController::build_tree(Category::get()),
            'breadcrumbs' => [
                [
                    'name' => __('Product'),
                    'url'  => 'admin/product'
                ]
            ]
        ];
        return view('ecommerce::admin.product.index',$data);
    }

    public function create(Request $request)
    {
        if (!empty($request->input())) {
            $data = $request->all();
            $row = new Product();
            $data['product_slug'] = HelpersController::utf8convert($request->input('product_name'));
            $row->fill($data);
            if ($row->save()) {
                return redirect('admin/product/create')->with('success', __('News Added'));
            }
        }
        $data = [
            'rows'        => HelpersController::build_tree(Category::get()),
            'row'         => new Product(),
            'breadcrumbs' => [
                [
                    'name' => __('Add Product'),
                    'url'  => 'admin/product/new'
                ]
            ]
        ];
        return view('ecommerce::admin.product.detail',$data);
    }




    public function bulkedit(Request $request)
    {
        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids) or !is_array($ids)) {
            return redirect()->back()->with('error', __('Please select at least 1 item!'));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('Please select an Action!'));
        }
        if ($action == 'delete') {
            foreach ($ids as $id) {
                Product::where("product_id", $id)->first()->delete();
            }
        } else {
            foreach ($ids as $id) {
                $query = Product::where("product_id", $id);

                $query->update(['status' => $action]);
            }
        }
        return redirect()->back()->with('success', __('Update success!'));
    }

}
