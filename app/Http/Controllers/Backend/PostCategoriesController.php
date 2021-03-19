<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Validator;


class PostCategoriesController extends Controller
{

    public function index()
    {


        if (!\auth()->user()->ability('admin', 'mmanage_post_categories,show_post_categories')) {
            return redirect('admin/index');
        }

        $keyword = (isset(\request()->keyword) && \request()->keyword != '') ? \request()->keyword : null;
        $status = (isset(\request()->status) && \request()->status != '') ? \request()->status : null;
        $sort_by = (isset(\request()->sort_by) && \request()->sort_by != '') ? \request()->sort_by : 'id';
        $order_by = (isset(\request()->order_by) && \request()->order_by != '') ? \request()->order_by : 'desc';
        $limit_by = (isset(\request()->limit_by) && \request()->limit_by != '') ? \request()->limit_by : '10';

        $categories = Category::withCount('posts');
        if ($keyword != null) {
            $categories = $categories->search($keyword);
        }


        if ($status != null) {
            $categories = $categories->whereStatus($status);
        }

        $categories = $categories->orderBy($sort_by, $order_by);
        $categories = $categories->paginate($limit_by);



        return view('backend.post_categories.index', compact('categories'));
    }

    public function create()

    {
        if (!\auth()->user()->ability('admin', 'create_post_categories')) {
            return redirect('admin/index');
        }


        return view('backend.post_categories.create');
    }


    public function store(Request $request)
    {
        if (!\auth()->user()->ability('admin', 'create_post_categories')) {
            return redirect('admin/index');
        }

        $validator = Validator::make($request->all(), [
            'name'             => 'required',
            'status'           => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $data['name']         =  $request->name;
        $data['status']        =  $request->status;


        Category::create($data);



        if ($request->status == 1) {
            Cache::forget('categories');
        }

        return redirect()->route('admin.post_categories.index')->with([
            'message' => 'Category created successfuly',
            'alert-type' => 'success'
        ]);
    }


    public function show($id)
    {
        if (!\auth()->user()->ability('admin', 'display_posts')) {
            return redirect('admin/index');
        }
    }


    public function edit($id)
    {
        if (!\auth()->user()->ability('admin', 'update_post_categories')) {
            return redirect('admin/index');
        }

        $category = Category::whereId($id)->first();

        return view('backend.post_categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        if (!\auth()->user()->ability('admin', 'update_post_categories')) {
            return redirect('admin/index');
        }

        $validator = Validator::make($request->all(), [
            'name'             => 'required',
            'status'            => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $category = Category::whereId($id)->first();

        if ($category) {

            $data['name']         =  $request->name;
            $data['slug']          =  null;
            $data['status']        =  $request->status;

            $category->update($data);
            Cache::forget('categories');

            return redirect()->route('admin.post_categories.index')->with([
                'message' => 'Category updated successfuly',
                'alert-type' => 'success'
            ]);
        }
        return redirect()->route('admin.post_categories.index')->with([
            'message' => 'Something was wrong',
            'alert-type' => 'danger'
        ]);
    }


    public function destroy($id)
    {
        if (!\auth()->user()->ability('admin', 'delete_posts')) {
            return redirect('admin/index');
        }

        $category = Category::whereId($id)->first();

        foreach ($category->posts as $post)
        {
            if ($post->media->count() > 0) {
                foreach ($post->media as $media) {
                    if (File::exists('assets/posts/' . $media->file_name)) {
                        unlink('assets/posts/' . $media->file_name);
                    }
                }
            }
        }

          $category->delete();

            return redirect()->route('admin.post_categories.index')->with([
                'message' => 'Category deleted successfuly',
                'alert-type' => 'success'
            ]);

    }
}
