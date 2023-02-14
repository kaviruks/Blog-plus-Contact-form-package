@extends('frontend.master')

@section('content')
    <div class="col-12">
        <div class="page-header">
            <h4 class="page-title">Create your existing Service/Product</h4>
        </div>
    </div>
    <div class="card-body">
        <form method="post" enctype="multipart/form-data" action="{{route('user.store_post')}}">
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
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="mb-sm-0">Post Title<code> *</code></label>
                            <input type="text"
                                   class="form-control form-control-sm form-control-border border-width-2"
                                   name="title">
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="mb-sm-0">Meta Title<code> *</code></label>
                            <input type="text"
                                   class="form-control form-control-sm form-control-border border-width-2"
                                   name="meta_title">
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

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="mb-sm-0">Image<code> *</code></label>
                            <input type="file" class="form-control form-control-sm form-control-file"
                                   name="post_image">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="mb-sm-0">Slug</label>
                            <input type="text"
                                   class="form-control form-control-sm form-control-border border-width-2"
                                   name="slug">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label class="mb-sm-0">Summary</label>
                            <textarea rows="3"
                                      class="form-control form-control-sm form-control-border border-width-2"
                                      name="summary"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label class="mb-sm-0">Content</label>
                            <textarea rows="3" id="post_content_editor"
                                      class="form-control form-control-sm form-control-border border-width-2"
                                      name="post_content"></textarea>
                        </div>
                    </div>
                </div>
                <button class="form-control-sm btn btn-success mt-3" type="submit">Save</button>
            </div>
        </form>
    </div>
@endsection
