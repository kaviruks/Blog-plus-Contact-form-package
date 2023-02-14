{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css">
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('library/toastr/css/toastr.min.css') }}">

    <title>Contact Form</title>
</head> --}}
@extends('contact::frontend.master')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Contact Form</h1>
            </div>

            <div class="section-body">



                <div class="row">
                    <div class="col">
                        <div class="card">
                            <form id="form-contact" method="post" action="/store">
                                @csrf
                                <div class="card-header">
                                    <h4>Fill all details</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Name</label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                required="">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Email</label>
                                            <input type="email" id="email" name="email" class="form-control"
                                                required="">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Meesage</label>
                                            <textarea rows="3" id="message" name="message"
                                                class="form-control form-control-sm form-control-border border-width-2"></textarea>
                                        </div>

                                    </div>
                                </div>
                        </div>
                        <div class="card-footer text-center">


                            <input id="save" type="submit" class="btn btn-success btn-lg mr-2" value="Save">

                            <input id="reset" type="reset" class="btn btn-danger btn-lg mr-2" value="Reset">


                        </div>
                        </form>
                    </div>



                </div>

            </div>
    </div>
    </section>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('library/toastr/js/toastr.min.js') }}"></script>


    @if (session()->has('successmsg'))
        <script>
            $(document).ready(function() {
                toastr.options = {
                    "progressBar": true
                };
                toastr.success('{{ session()->get('successmsg') }}');

            });
        </script>
    @endif

    @if (session()->has('errormsg'))
        <script>
            $(document).ready(function() {
                toastr.options = {
                    "progressBar": true
                };
                toastr.error('{{ session()->get('errormsg') }}');

            });
        </script>
    @endif


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>
   

@endsection



{{-- </html> --}}
