<?php

namespace App\Http\Controllers\User;

use App\Models\Tag;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Category;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PostController extends Controller
{

//view post create page
    public function create_post()
    {
        //check user permission
        $user = Auth::user();
        if ($user->can('create post')) {
//            if user have permission to create post
            $categories = Category::with('children')->withCount('children')
                ->whereNull('parent_id')->orderBy('title', 'ASC')
                ->get();
            $tags = Tag::all();
            return view('user.create', compact('tags', 'categories'));
        } else {
//            user haven't permission to create page'
            return redirect()->route('user.home')->with('toast_error', 'Ops! You dont have Permission!');
        }
    }

//view single view page
    public function single_view($post_id)
    {
        //check user permission
        $user = Auth::user();
        if ($user->can('view post')) {
//            if user have permission to view single post

            $single_post = Post::find($post_id);

            $selected_category = PostCategory::where('post_id', $post_id)->first();
            $category_name = Category::where('id', $selected_category['category_id'])->value('title');

            $tag_names = [];
            $selected_tags = PostTag::where('post_id', $post_id)->get();
            foreach ($selected_tags as $selected_tag) {
                array_push($tag_names, Tag::where('id', $selected_tag['tag_id'])->value('title'));
            }
            return view('user.single', compact('single_post', 'category_name', 'tag_names'));
        } else {
//            if user haven't permission
            return redirect()->route('user.home')->with('toast_error', 'Ops! You dont have Permission!');
        }
    }

    public function delete_post($post_id)
    {
        //check user permission
        $user = Auth::user();
        if ($user->can('un_publish post')) {
            $post = Post::find($post_id);
            $post->published = 0;
            $post->save();
            return redirect()->route('user.home')->with('toast_success', 'Post Unpublished Successfully!');
        } else {
            return redirect()->route('user.home')->with('toast_error', 'Ops! You dont have Permission!');
        }
    }

    public function active_post($post_id)
    {
        //check user permission
        $user = Auth::user();
        if ($user->can('publish post')) {
            $post = Post::find($post_id);
            $post->published = 1;
            $post->save();
            return redirect()->route('user.home')->with('toast_success', 'Post Published successfully');
        } else {
            return redirect()->route('user.home')->with('toast_error', 'Ops! You dont have Permission!');
        }
    }

    public function edit_post($post_id)
    {
        $user = Auth::user();
        if ($user->can('edit post')) {
            $single_post = Post::findOrFail($post_id);
            $categories = Category::with('children')->withCount('children')
                ->whereNull('parent_id')->orderBy('title', 'ASC')
                ->get();
            $tags = Tag::all();

            $selected_category = PostCategory::where('post_id', $post_id)->first();
            $category_name = Category::where('id', $selected_category['category_id'])->value('title');

            $tag_names = [];
            $selected_tags = PostTag::where('post_id', $post_id)->get();
            foreach ($selected_tags as $selected_tag) {
                array_push($tag_names, Tag::where('id', $selected_tag['tag_id'])->value('title'));
            }

            return view('user.edit', compact('single_post', 'categories', 'category_name', 'tags', 'tag_names'));
        } else {
            return redirect()->route('user.home')->with('toast_error', 'Ops! You dont have Permission!');
        }
    }

    public function update_post(Request $request, $post_id)
    {
        //check user permission
        $user = Auth::user();
        if ($user->can('edit post')) {
            //check Post has this post id
            $post = Post::findorFail($post_id);
            if ($post) {
                //check validations
                $validator = Validator::make($request->all(), [
                    'title' => 'required',
                    'meta_title' => 'required',
                    'post_content' => 'required',
                ]);
                // if validation is fail return redirect
                if ($validator->fails()) {
                    return redirect()
                        ->back()
                        ->with('toast_error', $validator->messages()->all()[0])
                        ->withInput();
                }

                // if validate pass
                // chack image is selceted
                if ($request->post_image !== null) {
                    //delete recently uploaded image
                    if (Storage::disk('public')->exists($post->image_path)) {
                        Storage::disk('public')->delete($post->image_path);
                    }
                    //save new image
                    $image = Storage::disk('public')->put('uploads/posts/images', $request->post_image);
                    $post->image_path = $image;
                }

                $post->title = $request->title;
                $post->meta_title = $request->meta_title;
                $post->slug = $request->slug;
                $post->published = 1;
                $post->summary = $request->summary;
                $post->content = $request->post_content;
                $post->save();

                $post_categoties = new PostCategory();
                $post_categoties->post_id = $post->id;
                $post_categoties->category_id = $request->category_id;
                $post_categoties->save();

                if ($request->tags_id !== null) {
                    foreach ($request->tags_id as $tag_id) {
                        $post_tags = new PostTag();
                        $post_tags->post_id = $post->id;
                        $post_tags->tag_id = $tag_id;
                        $post_tags->save();
                    }
                }
                return redirect()->route('user.home')->with('toast_success', 'Post Updated successfully');
            } else {
                return redirect()->back()->with('toast_error', 'Ops! Something Went wrong!')->withInput();
            }

        } else {
            return redirect()->route('user.home')->with('toast_error', 'Ops! You dont have Permission!');
        }
    }

    public function store_post(Request $request)
    {
        //check user permission
        $user = Auth::user();
        if ($user->can('create post')) {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'meta_title' => 'required',
                'post_image' => 'required',
                'post_content' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->with('toast_error', $validator->messages()->all()[0])
                    ->withInput();
            }

            $image = Storage::disk('public')->put('uploads/posts/images', $request->post_image);

            $post = new Post();
            $post->author_id = 1;
            $post->parent_id = 1;
            $post->title = $request->title;
            $post->meta_title = $request->meta_title;
            $post->image_path = $image;
            $post->slug = $request->slug;
            $post->published = 1;
            $post->summary = $request->summary;
            $post->content = $request->post_content;
            $post->save();

            $post_categoties = new PostCategory();
            $post_categoties->post_id = $post->id;
            $post_categoties->category_id = $request->category_id;
            $post_categoties->save();


            foreach ($request->tags_id as $tag_id) {
                $post_tags = new PostTag();
                $post_tags->post_id = $post->id;
                $post_tags->tag_id = $tag_id;
                $post_tags->save();
            }
            return redirect()->back()->with('toast_success', 'Post Created successfully');
        } else {
            return redirect()->route('user.home')->with('toast_error', 'Ops! You dont have Permission!');
        }
    }

    public function inline(Request $request)
    {
        $user = Auth::user();
        if ($user->can('edit post')) {
            $post = Post::findorFail($request->post_id);
            if ($post) {
                $post->content = $request->post_content;
                $post->save();
                if ($request->is_ajax_call) {
                    return response()->json(['success' => 'Post content edited Successfully']);
                }
            }
        } else {
            if ($request->is_ajax_call) {
                return response()->json(['error' => 'Ops! You dont have Permission!']);
            }
        }
    }
}
