<?php

namespace Demo\Ecommerce\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class HelpersController extends Controller
{
	protected $path_img_originals = 'public/images/originals/';
	protected $path_img_thumbnails = 'public/images/thumbnails/';

	function __construct(){

    }

	/**
	 * @param $str string
	 * @return bool|mixed|null|string|string[]
	 */
	public static function utf8convert($str)
	{
		if (!$str) return false;
		$utf8 = array(
			'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
			'd' => 'đ|Đ',
			'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
			'i' => 'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
			'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
			'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
			'y' => 'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
		);
		foreach ($utf8 as $ascii => $uni) $str = preg_replace("/($uni)/i", $ascii, $str);
		$str = strtolower($str);
		$str = str_replace("ß", "ss", $str);
		$str = str_replace("%", "", $str);
		$str = preg_replace("/[^_a-zA-Z0-9 -] /", "", $str);
		$str = str_replace(array('%20', ' '), '-', $str);
		$str = str_replace("----", "-", $str);
		$str = str_replace("---", "-", $str);
		$str = str_replace("--", "-", $str);
		return $str;
	}

	/*
	 * @param $flat collection
	 */
    public static function build_tree ($flat) {
        $_this = new HelpersController();
        $tree = [];
        foreach ($flat as $item) {
            if ($item->parent_id == null) {
                $children = $flat->where('parent_id', $item->category_id);
                if (count($children) > 0) {
                    $item->children = $_this->build_child_tree($children, $flat);
                } else {
                    $item->children = $children;
                }

                $tree[] = $item;
            }
        }
        return collect($tree);
    }


    public function build_child_tree ($children, $flat) {
        $items = [];
        foreach ($children as $item) {
            $children_2 = $flat->where('parent_id', $item->category_id);
            if (count($children_2) > 0) {
                $item->children = $this->build_child_tree($children_2, $flat);
            } else {
                $item->children = $children_2;
            }
            $items[] = $item;
        }

        return collect($items);

    }


    public static function html_category ($category, $prefix = '') {
        $html = '
            <tr>
                <td><input type="checkbox" name="ids[]" value="'.$category->category_id.'"
                           class="check-item">
                </td>
                <td class="title">
                    <a href="javascript:void(0)">'.$prefix.$category->category_name.'</a>
                </td>
                <td>'.$category->category_slug.'</td>
                <td class="d-none d-md-block">'.$category->updated_at.'</td>
            </tr>
        ';
        if (count($category->children) > 0) {
            $prefix = $prefix.' - ';
            foreach ($category->children as $child) {
                $html .= HelpersController::html_category_child($child, $prefix);
            }
        }
        return $html;
    }

    public static function html_category_child ($category, $prefix) {
        $html = '
            <tr>
                <td><input type="checkbox" name="ids[]" value="'.$category->category_id.'"
                           class="check-item">
                </td>
                <td class="title">
                    <a href="javascript:void(0)">'.$prefix.$category->category_name.'</a>
                </td>
                <td>'.$category->category_slug.'</td>
                <td class="d-none d-md-block">'.$category->updated_at.'</td>
            </tr>
        ';
        if (count($category->children) > 0) {
            $prefix = $prefix.' - ';
            foreach ($category->children as $child) {
                $html .= HelpersController::html_category_child($child, $prefix);
            }
        }
        return $html;
    }

    public static function html_category_option ($category, $prefix = '') {
        $html = '
            <option value="'.$category->category_id.'">'.$prefix.$category->category_name.'</option>
        ';
        if (count($category->children) > 0) {
            $prefix = $prefix.' - ';
            foreach ($category->children as $child) {
                $html .= HelpersController::html_category_option_child($child, $prefix);
            }
        }

        return $html;
    }
    public static function html_category_option_child ($category, $prefix) {
        $html = '
            <option value="'.$category->category_id.'">'.$prefix.$category->category_name.'</option>
        ';
        if (count($category->children) > 0) {
            $prefix = $prefix.' - ';
            foreach ($category->children as $child) {
                $html .= HelpersController::html_category_option_child($child, $prefix);
            }
        }
        return $html;
    }
}
