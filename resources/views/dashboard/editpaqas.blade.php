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
                            <img src="{{asset('images/profile.svg')}}">
                        </div>
                        <div class="col-6">
                            <h5>{{auth()->user()->name}}</h5>
                            <p>ادمن</p>

                        </div>

            
                            </div>
                        </div>
                        <div class="flag">

                            <div class="row">
                                <div class="col-4">
                                    <img src="{{asset('images/flag.svg')}}">
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
                                <p>{{ Carbon\Carbon::now()->format('d-m-Y')}}</p>
                            </div>
                        </div>


                    </div>


                </div>
                <!--end heed-->


                <!--start setting-->
             @error('name')
   <p style="margin: 33px auto;
    background: #dc354559;
    color: #dc3545;
    font-weight: bold;
    text-align: center;
    border-radius: 5px;
    padding: 10px 20px;
    box-shadow: 0px 3px 6px #dc35454d;
     }">{{ $message }}</p>
   @enderror
                <div class="setting">
                    <div class="container">
                        <div class="row def">
                            <img src="{{asset('images/setting.svg')}}">
                            <h5>تعديل باقه</h5>
                        </div>
                            <form method="post" action="{{route('updatepaqas',$p->id)}}" enctype="multipart/form-data">
                        	@csrf
                           
                        
                        <div class="info">
                            <div class="row">
                          
                                   
                     <div class="form-group col-lg-4 col-md-6 col-12">
                                     
                                   <label for="pay">الاسم بالعربي</label><br >
                                   <input id="pay" style="height:35px;" type="text" value="{{ $p->name }}" required  name="name">
                                 
                               </div>
                               
                               <div class="form-group col-lg-4 col-md-6 col-12">
                                     
                                   <label for="pay">الاسم بالانجليزي </label><br >
                                   <input id="pay" style="height:35px;" type="text" value="{{ $p->name_en }}" required  name="name_en">
                                 
                               </div>
                               
                                <div class="form-group col-lg-4 col-md-6 col-12">
                                     
                                   <label for="pay2">القيمه</label><br >
                                   <input id="pay2" style="height:35px;" type="number" required value="{{ $p->value }}" name="value">
                                 
                               </div>
                                    <div class="form-group col-lg-4 col-md-6 col-12">
                                    <label>النوع</label>
                      <select name="type" class="form-control selectpicker" required   data-live-search="true" >
                         
                          <option value="1" @if ($p->type == "1") {{ 'selected' }}@endif>"يوم"</option>
                         
                         
                          <option value="2" @if ($p->type  == "2") {{ 'selected' }}@endif>"شهر"</option>
                         
                         
                          <option value="3" @if($p->type == "3") {{ 'selected' }}@endif>"سنه"</option>
                         
                      </select>
                           </div>
                               
                               
                                <div class="form-group col-lg-4 col-md-6 col-12">
                                     
                                   <label for="pay2">الحجم</label><br >
                                   <input id="pay2" style="height:35px;" type="number" value="{{ $p->size }}" required name="size">
                                 
                               </div>
                               
                               <div class="form-group col-lg-4 col-md-6 col-12">
                                     
                                   <label for="pay2">عدد المستخدمين</label><br >
                                   <input id="pay2" style="height:35px;" type="number"  value="{{ $p->num_users }}" name="num_user">
                                 
                               </div>
                               
                               
                                <div class="form-group col-lg-4 col-md-6 col-12">
                                     
                                   <label for="pay2">السعر</label><br >
                                   <input id="pay2" style="height:35px;" type="number" value="{{ $p->price }}" required   name="price">
                                 
                               </div>
                               
                         
                            </div>
                        
                  
                    
                    
                    
                           

                        <div class="save text-center mt-6">
                            <div class="row save">
                                <div class="col-12 text-center">
                                  <input type="submit" value="حفظ" class="text-center">

                                </div>

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
                        <h5>Made With <img src="{{asset('images/red.svg')}}"> By Crazy Idea </h5>
                        <p>Think Out Of The Box</p>
                    </div>
                </div>
            </div>
            <!--end foter-->
        </div>
    </div>
    <!--end page-body-->

@endsection
