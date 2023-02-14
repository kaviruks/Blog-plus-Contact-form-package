@extends('frontend.master')

@section('content')
    <div class="col-12">
        <div class="page-header">
            <h4 class="page-title">Service/Product View</h4>
        </div>
    </div>
    <div class="card card-body">
        <div class="row">
            @if($single_post)
                <div class="row ml-4 pr-4 py-4">
                    <div class="card">
                        <img class="card-img-top w-25 mt-3 ml-2" style="height: 200px"
                             src="{{asset('storage/'.$single_post['image_path'])}}"
                             alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title" id="title">{{$single_post['title']}}</h5>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label class="text-muted">{{$category_name}}</label>
                                    @foreach($tag_names as $tag_name)
                                        <span class="badge bg-primary">{{$tag_name}}</span>
                                    @endforeach
                                </div>
                            </div>

                            <small class="text-muted">{{$single_post['meta_title']}}</small>
                            <div class="">
                                <label><strong>Summary</strong></label>
                                <p>{!!$single_post['summary']!!}</p>
                            </div>
                            <label><strong>Content</strong></label>

                            <div @can('edit post')
                                 id="editor1" contenteditable="true"
                                @endcan>
                                <p>{!! $single_post['content'] !!}</p>
                            </div>

                        </div>
                        <div class="card-footer">
                            <small class="text-muted">$. 427</small>
                            <div class="float-end">
                                @if($single_post['published'] === 1)
                                    @can('un_publish post')
                                        <a href="{{route('user.delete_post',[$single_post->id])}}"
                                           class="btn btn-outline-danger form-control-sm text-decoration-none"><i
                                                class="bi bi-lock-fill"></i> Un publish Post</a>
                                    @endcan
                                @else
                                    @can('publish post')
                                        <a href="{{route('user.active_post',[$single_post->id])}}"
                                           class="btn btn-outline-success form-control-sm"><i
                                                class="bi bi-unlock-fill"></i> Publish Post</a>
                                    @endcan
                                @endif
                                @can('edit post')
                                    <a href="{{route('user.edit_post',[$single_post->id])}}"
                                       class="btn btn-outline-secondary form-control-sm"><i
                                            class="bi bi-pencil"></i></a>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row ml-4 pr-4 py-5 not-fount">
                    <div class="col-md-12 text-center">
                        <h6 class="pt-3 text-muted text-uppercase">Sorry, No results found!</h6>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <script type="text/javascript">
        var posts = {!! json_encode($single_post->toArray()) !!};
        CKEDITOR.disableAutoInline = true;
        $("div[contenteditable='true']").each(function (index) {
            var content_id = $(this).attr('id');
            CKEDITOR.inline(content_id, {
                on: {
                    blur: function (event) {
                        var data = event.editor.getData();
                        // alert("Sending: " + data)

                        var request = jQuery.ajax({
                            url: '/user/post/inline',
                            type: "POST",
                            data: {
                                post_id: JSON.stringify(posts.id),
                                post_content: data,
                                _token: '{{ csrf_token() }}',
                                is_ajax_call: true
                            },
                            success: function (data) {
                                console.log(data);
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                });

                                if (data.success) {
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Post content edited Successfully'
                                    });

                                }
                                if (data.error) {
                                    Toast.fire({
                                        icon: 'error',
                                        title: 'Ops! You dont have Permission to edit content'
                                    });
                                }
                            }
                        })
                    }
                }
            });
        });
    </script>
@endpush
