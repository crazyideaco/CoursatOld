@extends('App.dash')
@section('content')
    <!--start page-body-->
    <div class="page-body">
        <div class="container">
            <!--start heed-->
            <div class="heed">

                <div class="row">
                    <div class="profile">
                        <div class="row">
                            <div class="col-3">
                                <img src="{{ asset('images/profile.svg') }}">
                            </div>
                            <div class="col-6">
                                {{-- <h5>{{ auth()->user()->name }}</h5> --}}
                                <p>ادمن</p>

                            </div>


                        </div>
                    </div>
                    <div class="flag">

                        <div class="row">
                            <div class="col-4">
                                <img src="{{ asset('images/flag.svg') }}">
                            </div>
                            <div class="col-4">
                                <h5>العربية</h5>


                            </div>



                        </div>

                    </div>


                    <div class="noti text-center">
                        <span><i class="far fa-bell"></i></span>
                    </div>



                    <div class="search">

                        <input type="text" name="search">
                        <span class="srch"><i class="fas fa-search"></i></span>

                    </div>

                    <div class="datee">
                        <div class="row">
                            <span><i class="far fa-calendar-alt"></i></span>
                            <p>{{ Carbon\Carbon::now()->format('d-m-Y') }}</p>
                        </div>
                    </div>


                </div>


            </div>
            <!--end heed-->
            <!--start setting-->
            <div class="setting">
                <div class="container">
                    <div class="row def">
                        <img src="{{ asset('images/setting.svg') }}">
                        <h5>اضافة حملة  </h5>
                    </div>
                    <form method="post" action="{{ route('campaigns.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="info">
                            <div class="row">

                                <div class="form-group col-3">
                                    <label>اسم الوسيله </label>
                                    <input type="text" class="form-control" placeholder="ادخل اسم " name="title"
                                        value="{{ old('title') }}"required>
                                    @error('title')
                                        <div style="color:red;">{{ $message }} </div>
                                    @enderror
                                </div>

                                <div class="form-group col-3">
                                    <label>رقم الوسيلة </label>
                                    <input type="text" class="form-control" placeholder="ادخل الرقم " name="description"
                                        value="{{ old('description') }}"required>
                                    @error('description')
                                        <div style="color:red;">{{ $message }} </div>
                                    @enderror
                                </div>

                                <div class="form-group col-3">
                                    <label>بداية الحملة</label>
                                    <input type="date" class="form-control" placeholder="ادخل تاريخ البدء" name="start_date"
                                        value="{{ old('start_date') }}"required>
                                    @error('start_date')
                                        <div style="color:red;">{{ $message }} </div>
                                    @enderror
                                </div>

                                <div class="form-group col-3">
                                    <label> نهاية الحملة </label>
                                    <input type="text" class="form-control" placeholder=" ادخل تاريخ الانتهاء " name="end_date"
                                        value="{{ old('end_date') }}"required>
                                    @error('end_date')
                                        <div style="color:red;">{{ $message }} </div>
                                    @enderror
                                </div>

                                {{-- @if (auth()->user()->isAdmin === "admin") --}}

                                <div class="form-group col-3">
                                    <h5> نوع المنصه </h5>
                                    <input type="checkbox" name="facebook" id="facebook">
                                    <label for="facebook">Facebook</label>
                                    <input type="checkbox" name="instagram" id="instagram">
                                    <label for="instagram">Instagram</label>
                                    <input type="checkbox" name="tiktok" id="tiktok">
                                    <label for="tiktok">Tiktok</label>
                                    <input type="checkbox" name="youtube" id="youtube">
                                    <label for="youtube">Youtube</label>
                                    <input type="checkbox" name="whatsapp" id="whatsapp">
                                    <label for="whatsapp">WhatsApp</label>
                                    <input type="checkbox" name="x" id="x">
                                    <label for="x">X</label>
                                    @error('center_id')
                                        <div style="color:red;">{{ $message }} </div>
                                    @enderror
                                </div>

                                <div class="form-group col-3">
                                    <label> الاستهداف </label>
                                    <select class="form-control" name="center_id" required>
                                        <input type="checkbox" name="academic" id="academic">
                                    <label for="academic">اكاديمي</label>
                                    <input type="checkbox" name="basic" id="basic">
                                    <label for="basic">اساسي</label>
                                    </select>
                                    @error('center_id')
                                        <div style="color:red;">{{ $message }} </div>
                                    @enderror
                                </div>

                                <div class="form-group col-3">
                                    <label>  الجامعه</label>
                                    <select class="form-control" name="university" required>
                                        @foreach ( $centers as $center)
                                        <option value="{{$center->id}}">{{$center->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('university')
                                        <div style="color:red;">{{ $message }} </div>
                                    @enderror
                                </div>
                                <div class="form-group col-3">
                                    <label> الكلية </label>
                                    <select class="form-control" name="college" required>
                                        @foreach ( $centers as $center)
                                        <option value="{{$center->id}}">{{$center->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('college')
                                        <div style="color:red;">{{ $message }} </div>
                                    @enderror
                                </div>
                                <div class="form-group col-3">
                                    <label>  المرحلة</label>
                                    <select class="form-control" name="center_id" required>
                                        @foreach ( $centers as $center)
                                        <option value="{{$center->id}}">{{$center->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('center_id')
                                        <div style="color:red;">{{ $message }} </div>
                                    @enderror
                                </div>
                                <div class="form-group col-3">
                                    <label> الصف </label>
                                    <select class="form-control" name="center_id" required>
                                        @foreach ( $centers as $center)
                                        <option value="{{$center->id}}">{{$center->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('center_id')
                                        <div style="color:red;">{{ $message }} </div>
                                    @enderror
                                </div>
                                <div class="form-group col-3">
                                    <label>  المادة</label>
                                    <select class="form-control" name="center_id" required>
                                        @foreach ( $centers as $center)
                                        <option value="{{$center->id}}">{{$center->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('center_id')
                                        <div style="color:red;">{{ $message }} </div>
                                    @enderror
                                </div>
                                {{-- @endif --}}
                            </div>
                        </div>
                        <div class="save text-center mt-6">
                            <div class="row save">
                                <div class="col-12 text-center">
                                    <input type="submit" value="حفظ" class="text-center">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--end setting-->
        <!--start foter-->
        <div class="foter">
            <div class="row">
                <div class="col-12 text-center">
                    <h5>Made With <img src="{{ asset('images/red.svg') }}"> By Crazy Idea </h5>
                    <p>Think Out Of The Box</p>
                </div>
            </div>
        </div>
        <!--end foter-->
    </div>
    </div>
    <!--end page-body-->
@endsection
@section('scripts')
@endsection
