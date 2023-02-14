@extends('frontend.master')

@section('content')
    <div class="col-12">
        <div class="page-header">
            <h4 class="page-title">Edit your existing Service/Product</h4>
        </div>
    </div>

    <div class="card-body ">
        <form method="post" enctype="multipart/form-data" action="{{route('user.update_post',['post_id'=>$single_post->id])}}">
            @csrf
            <div class="m-lg-4">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="mb-sm-0">Post Category <code> *</code></label>
                            <select class="form-control form-control-sm" name="category_id">
                                @if(count($categories)> 0)
                                    @foreach($categories as $category)
                                        @if(count($category->children) >0)
                                            <optgroup label="{{$category['title']}}">
                                                @if(count($category->children) >0)
                                                    @foreach($category->children as $child)
                                                        <option value="{{$child['id']}}">{{$child['title']}}</option>
                                                    @endforeach
                                                @endif
                                            </optgroup>
                                        @else
                                            <option value="{{$category['id']}}">{{$category['title']}}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="mb-sm-0"><strong>Seleccted Category</strong></label><br>
                            <label class="text-muted">{{$category_name}}</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="mb-sm-0">Post Title<code> *</code></label>
                            <input type="text"
                                   class="form-control form-control-sm form-control-border border-width-2"
                                   name="title" value="{{$single_post->title}}">
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="mb-sm-0">Meta Title<code> *</code></label>
                            <input type="text"
                                   class="form-control form-control-sm form-control-border border-width-2"
                                   name="meta_title" value="{{$single_post->meta_title}}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label class="mb-sm-0">Property Tag<code> *</code></label>
                            <select class="form-control form-control-sm js-example-basic-multiple w-100"
                                    name="tags_id[]" multiple="multiple">
                                @foreach($tags as $tag)
                                    <option value="{{$tag->id}}">{{$tag->title}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>

                <div class="form-group">
                    <label class="mb-sm-0">Selected Tags</label><br>
                    @foreach($tag_names as $tag_name)
                        <span class="badge bg-primary">{{$tag_name}}</span>
                    @endforeach
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="mb-sm-0">Image<code> *</code></label>
                            <input type="file" class="form-control form-control-sm form-control-file"
                                   name="post_image">
                        </div>
                        <div class="form-group">
                            <label class="mb-sm-0">Slug</label>
                            <input type="text"
                                   class="form-control form-control-sm form-control-border border-width-2"
                                   name="slug" value="{{$single_post->slug}}">
                        </div>

                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <img class="card-img-top w-50 h-50" src="{{asset('storage/'.$single_post['image_path'])}}"
                                 alt="Card image cap">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label class="mb-sm-0">Summary</label>
                            <textarea rows="3"
                                      class="form-control form-control-sm form-control-border border-width-2"
                                      name="summary">{{$single_post->summary}}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label class="mb-sm-0">Content</label>
                            <textarea id="post_content_editor_edit"
                                      class="form-control form-control-sm form-control-border border-width-2"
                                      name="post_content">{{$single_post->content}}</textarea>
                        </div>
                    </div>
                </div>
                <button class="form-control-sm btn btn-success mt-3" type="submit">Edit</button>
            </div>
        </form>
    </div>
@endsection
