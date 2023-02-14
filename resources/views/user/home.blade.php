@extends('frontend.master')

@section('content')
    <div class="col-12">
        <div class="page-header">
            <h4 class="page-title">Service/Product</h4>
        </div>
    </div>
    <div class="card card-body">
        <div class="row">
            @if(!count($posts) > 0)
                <div class="row ml-4 pr-4 py-5 not-fount">
                    <div class="col-md-8 text-center">
                        {{--                        <img src="{{ asset('img/not-found.png') }}" alt="Not Found">--}}
                        <h6 class="pt-3 text-muted text-uppercase">Sorry, No results found!</h6>
                    </div>
                </div>
            @else
                @foreach($posts as $post)
                    <div class="col-sm-4 mb-3">
                        <a class=" text-decoration-none"
                           href="{{route('user.single_view', ['post_id' => $post->id])}}">
                            <div class="card">
                                <img class="card-img-top w-auto" style="height: 250px"
                                     src="{{asset('storage/'.$post['image_path'])}}"
                                     alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">{{$post['title']}}</h5>
                                    <small class="text-muted">{{$post['meta_title']}}</small>
                                    <p>{{ \Illuminate\Support\Str::limit($post['summary'], 100, $end = "...") }}</p>
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted">$. 427</small>
                                    {{--                                <button class="float-end btn btn-info form-control-sm"><a class=" text-decoration-none"--}}
                                    {{--                                        href="{{route('user.single_view', ['post_id' => $post->id])}}"><i--}}
                                    {{--                                            class="bi-eye"></i> view</a></button>--}}
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
                    <div class="pagination-sm">
                        {{$posts->links()}}
                    </div>
            @endif
        </div>
@endsection
