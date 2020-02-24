<?php
namespace Demo\Ecommerce\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Demo\Ecommerce\Models\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        if (empty($request->input('category_name')) == false) {
            $row = new Category($request->input());
            if (Category::where('category_name', $request->input('category_name'))->where('parent_id', $request->input('parent_id'))->exists()) {
                return redirect()->back()->with('error', __('Category is Existed !'));
            } else {
                $row->status = 'publish';
                $row->parent_id = $request->input('parent_id');
                if ($request->input('category_slug') == null) {
                    $row->category_slug = HelpersController::utf8convert($request->input('category_name'));
                }
                if ($row->save()) {
                    //$row->saveSEO($request);
                    return redirect('admin/category')->with('success', __('Category is created!'));
                }
            }
        }
        $catlist = new Category;
        if ($catename = $request->query('s')) {
            $list = \DB::select($catlist->query_build($catename));
            $catlist = HelpersController::build_tree(collect($list));
        } else {
            $catlist = HelpersController::build_tree($catlist->get());
        }
        $rows = $catlist;   //dd($rows);
        $data = [
            'rows' => $rows,
            'row' => new Category(),
            'breadcrumbs' => [
                [
                    'name' => __('Category'),
                    'class' => 'active'
                ],
            ],
        ];
        return view('ecommerce::admin.category.index',$data);
    }

    public function edit(Request $request, $id)
    {
        $row = Category::find($id);
        if (empty($row)) {
            return redirect('admin/module/news/category');
        }
        if (!empty($request->input())) {
            $row->fill($request->input());
            if ($row->save()) {
                return redirect('admin/category/edit/'.$id)->with('success', __('Category updated'));
            }
        }
        $data = [
            'row' => $row,
            'parents' => HelpersController::build_tree(Category::get())
        ];
        return view('News::admin.category.detail', $data);
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
                Category::where("category_id", $id)->first()->delete();
            }
        }
        return redirect()->back()->with('success', __('Update success!'));
    }


}
