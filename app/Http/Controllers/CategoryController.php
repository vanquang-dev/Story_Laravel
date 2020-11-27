<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\StoryModel;

class CategoryController extends Controller
{
    //
    /**
     * ---------------------------------------------------------------------------------
     * ---------------------------------START CATEGORY----------------------------------
     * ---------------------------------------------------------------------------------
     */

    /**
     * Them the loai
     */
    public function add_category(Request $request)
    {
        if ($request->name == '') {
            return response(["code" => 400, "message" => "Không được để trống!"], 400);
        }
        $category = new CategoryModel;
        $CheckExist = $category->where('category_name', $request->name)->count();
        if ($CheckExist != 0) {
            return response(["code" => 400, "message" => "Thể loại đã có rồi!"], 400);
        }
        $category->category_name = $request->name;
        $category->save();
        return response(["code" => 200, "message" => "Thêm thành công"], 200);
    }
    
    /**
     * Hien thi
     */
    public function show_category()
    {
        $data = CategoryModel::paginate(5);
        // $result = $category->get()->toArray();
        $result=[];
        $i =0;
        foreach($data as $result) {
            $result[$i]['id'] = $data->id;
            $result[$i]['category_name'] = $data->category_name;
            $i++;
        }
        return $result;
    }

    /**
     * Hien thi
     */
    public function category()
    {
        $category = CategoryModel::paginate(5);
        return view('admin.add_category', ['category'=>$category]);
    }
    /**
     * Xoa
     */
    public function destroy_category(Request $request)
    {
        //
        $category = new CategoryModel;
        $category->destroy(['id'=>$request->id]);
        return response(["code" => 200, "message" => "Xoa thanh cong"], 200);
    }

    /**
     * ---------------------------------------------------------------------------------
     * ---------------------------------END CATEGORY-------------------------------------
     * ---------------------------------------------------------------------------------
     */
}
