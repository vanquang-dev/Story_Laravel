<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\StoryModel;
use App\Models\Story_Category;
use App\Models\Chapter_Story;
use Spatie\Searchable\Search;
use Spatie\Searchable\ModelSearchAspect;
use Spatie\Searchable\Searchable;

class StoryController extends Controller
{
    

     /**
     * ---------------------------------------------------------------------------------
     * ---------------------------------START STORY-------------------------------------
     * ---------------------------------------------------------------------------------
     */

    /**
     * Them
     */
    public function add_story(Request $request)
    {
        if ($request->story_name == '' || $request->description == '' || $request->image == '') {
            return response(["code" => 400, "message" => "Cần điền đầy đủ!"], 400);
        }
        $story = new StoryModel;
        $CheckExist = $story->where('story_name', $request->story_name)->count();
        if ($CheckExist != 0) {
            return response(["code" => 400, "message" => "Truyện đã tồn tại!"], 400);
        }
        $story->story_name = $request->story_name;
        $story->description = $request->description;
        $story->image = $request->image;
        $story->status = $request->status;
        $story->save();

        if ($request->data != null) {
            $category_id = [];
            $i = 0;
            foreach ($request->data as $data) {
                if ($data!='') {
                    $category_id[$i] = $data;
                }
                $i++;
            }
            $hello = $story->where('story_name', $request->story_name)->first();
            $id = $hello->id;
            $story_category = StoryModel::find($id);
            $story_category->Category()->attach($category_id);
        }
        
        return response(["code" => 200, "message" => "Them thanh cong!"], 200);
    }

    /**
     * Hien thi
     */
    public function story()
    {
        $story = StoryModel::paginate(5);
        return view('admin.show_story', ['story'=>$story]);
    }
    /**
     * Xoa
     */
    public function destroy_story(Request $request)
    {
        //
        $story = new StoryModel;
        $story->destroy(['id'=>$request->id]);
        return response(["code" => 200, "message" => "Xoa thanh cong"], 200);
    }

    /**
     * search records in database and display  results
     * @param  Request $request
     * @return view
     */
    public function search(Request $request)
    {
        if ($request->search == '') {
            return redirect()->route('all-story');
        } else if (!isset($request->search)) {
            return view('admin.show_story');
        }
        $searchterm = $request->input('search');
        $searchResults = (new Search())
            ->registerModel(\App\Models\StoryModel::class, ['story_name']) //apply search on field story_name
            ->perform($searchterm);
        return view('admin.search_story' ,compact('searchResults', 'searchterm'));
    }
    /**
     * Hien thi edit truyen
     */
    public function show_edit_story($story_id)
    {
        $story = new StoryModel;
        $data = $story->where('id', $story_id)->get();
        $data2 =  CategoryModel::paginate();
        $story_category = new Story_Category;
        $data3 = $story_category->where('story_id', $story_id)->get();
        return view('admin.edit_story', ['data'=>$data, 'data2'=>$data2, 'data3'=>$data3]);
    }
    /**
     * Edit
     */
    public function edit_story(Request $request)
    {
        if ($request->story_name == '' || $request->description == '' || $request->image == '') {
            return response(["code" => 400, "message" => "Cần điền đầy đủ!"], 400);
        }
        $story = new StoryModel;

        $story->where('id', $request->id)->update([
            'story_name' => $request->story_name,
            'description' => $request->description,
            'image' => $request->image,
            'status' => $request->status
        ]);
        
        $story_category = StoryModel::find($request->id);
        
        if ($request->data != null) {
            $category_id = [];
            $i = 0;
            foreach ($request->data as $data) {
                if ($data!='') {
                    $category_id[$i] = $data;
                }
                $i++;
            }
            $story_category->Category()->detach();
            $story_category->Category()->attach($category_id);
        } else {
            $story_category->Category()->detach();
        }
        
        return response(["code" => 200, "message" => "Thành công!"], 200);
    }
    /**
     * Hien thi trang them truyen
     */
    public function show_add_story()
    {
        $category =  CategoryModel::paginate();
        return view('admin.add_story', ['data'=>$category]);
    }

    /**
     * Them chapter
     */
    public function add_chapter(Request $request)
    {
        if ($request->chapter == '' || $request->code == '') {
            return response(["code" => 400, "message" => "Cần điền đầy đủ!"], 400);
        }
        $Chapter_Story = new Chapter_Story;
        $Chapter_Story->story_id = $request->story_id;
        $Chapter_Story->chapter = $request->chapter;
        $Chapter_Story->title = $request->title;
        $Chapter_Story->detail_story = $request->code;
        $Chapter_Story->save();
        return response(["code" => 200, "message" => "Them thanh cong!"], 200);
    }

    /**
     * Hien thi truyen full
     */
    public function show_chapter($story_id)
    {
        $story = new StoryModel;
        $story_category = new Story_Category;
        $Chapter_Story = new Chapter_Story;
        $data = $Chapter_Story->where('story_id', $story_id)->get();
        $data2 = $story->where('id', $story_id)->first();
        $data3 = $story_category->where('story_id', $story_id)->get();
        return view('admin.show_chapter', ['data'=>$data, 'data2'=>$data2, 'data3'=>$data3]);
    }
    /**
     * Doc truyen
     */
    public function view_chapter(Request $request)
    {
        $Chapter_Story = new Chapter_Story;
        $data = $Chapter_Story->where('id', $request->id)->first();
        return $data;
    }
    /**
     * Doc truyen
     */
    public function show_home()
    {
        $data = StoryModel::paginate('8');
        return view('admin.home',['data' => $data]);
    }
    
     /**
     * ---------------------------------------------------------------------------------
     * ---------------------------------END STORY---------------------------------------
     * ---------------------------------------------------------------------------------
     */
}
