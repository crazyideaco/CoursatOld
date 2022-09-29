@extends('website.website_layout')
@section('centent')
<div class="cources">
      <div class="container">
        <div class="row">
            @foreach($courses as $course)
          <!-- For loop this card cource -->
          <div class="col-lg-4 col-md-6 col-12">
            <a href="single_course.html" class="card_cource">
              <img src="{{asset('uploads/'.$course->image)}}" alt="cource" />
              <div class="description_card">
                <h5 class="name">{{$course->name_ar ? ""}}</h5>
                <h6 class="instractor">{{$course->user_name ?? ""}}</h6>
                <p class="description">
                {{$course->description_ar ?? ""}}
                </p>
              </div>
            </a>
          </div>
          <!-- For loop this card cource -->
@endforeach
   

        </div>
      </div>
    </div>

@endsection