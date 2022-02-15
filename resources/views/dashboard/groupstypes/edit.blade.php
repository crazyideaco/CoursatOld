@extends('App.dash')
@section('content')
<style>
  .form-group button.dropdown-toggle{
 	width: 100% !important;
}.bootstrap-select .dropdown-toggle .filter-option{
		text-align: start;
}.setting .info button{
  width:100%;
}
  .fe{
    color:red !important;
    width: 35px !important;
    height: 35px;
    border-radius: 50%;
  
    font-family: med;
    font-size: 16px;
    background-color: transparent;
    border: 2px solid red;
    margin-top: 30px;
    display: inline-block;
    cursor:pointer
  }
	</style>
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
                <div class="setting">
                    <div class="container">
                        <div class="row def">
                            <img src="{{asset('images/setting.svg')}}">
                            <h5>تعديل مجموعه </h5>
                        </div>
                       <form method="post" action="{{route('updategrouptype',$group->id)}}" enctype="multipart/form-data">
                        	@csrf
                        <div class="info">
                
                         
                            <div class="row">
                                <div class="form-group col-lg-4 col-12">
                                    <label>اسم المجموعه بالعربى</label>
                    <input type="text" class="form-control" 
                            placeholder="ادخل اسم " required name="name_ar"
                            id="name_ar" value="{{$group->name_ar}}">
                            @error('name_ar')
                           <p style="color:red;">{{$message}}</p>
                            @enderror
                           </div>
                            </div>      
                                  <section id="section">
                                    @if($group->days)
                                    @foreach($group->days as $key => $groupday)
                                    @if($loop->first)
                              <div class="row">
                                <div class="col-lg-3 col-6">
                                  
                                  <label >اليوم</label>
                                  <select class="form-control selectpicker" data-live-search="true" style="width:100%;" required name="day_id[]">
                                    @foreach($days as $day)
                                    <option value="{{$day->id}}" @if($groupday->day_id == $day->id) selected @endif >{{$day->name_ar}}</option>
                                    @endforeach
                                  </select>
                                </div>
                                <div class="col-lg-3 col-6">
                                  
                                <label for="time1">من</label>
                             <input type="time" id="time1" name="from_time[]" class="form-control" value="{{$groupday->from_time}}" required="required">
                                                              
                                    </div>
                                <div class="col-lg-3 col-6">
                                   
                                <label>الى </label>
                                <input type="time" name="to_time[]" class="form-control" value="{{$groupday->to_time}}" required="required">
                                               
                                    </div>
                                <div class="col-lg-3 col-6">
                            <div class="optionz">              
                               <span class="text-center" id="app-btn12" style="cursor:pointer;" ><i class="fas fa-plus"></i></span>
                                
                            </div>

                        </div>
                                

                        

                            </div>
                                    @else
                                     <div class="row" id="c{{$key}}">
                                <div class="col-lg-3 col-6">
                                  
                                  <label >اليوم</label>
                                  <select class="form-control selectpicker" data-live-search="true" style="width:100%;" required name="day_id[]">
                                    @foreach($days as $day)
                                    <option value="{{$day->id}}" @if($groupday->day_id == $day->id) selected @endif >{{$day->name_ar}}</option>
                                    @endforeach
                                  </select>
                                </div>
                                <div class="col-lg-3 col-6">
                                  
                                <label for="time1">من</label>
                             <input type="time" id="time1" name="from_time[]" class="form-control" value="{{$groupday->from_time}}" required="required">
                                                              
                                    </div>
                                <div class="col-lg-3 col-6">
                                   
                                <label>الى </label>
                                <input type="time" name="to_time[]" class="form-control" value="{{$groupday->to_time}}" required="required">
                                               
                                    </div>
                               <div class="col-lg-3 col-6">
                            <div class="optionz" onclick="removerow({{$key}})" >              
                               <span class="text-center fe"  ><i class="fas fa-times" style="margin-right:4px;"></i></span>
                                
                            </div>

                        </div>
                       
                                

                        

                            </div>
                                    
                                    @endif
                                    @endforeach
                                    
                                    @else
                                       <div class="row">
                                <div class="col-3">
                                  
                                  <label >اليوم</label>
                                  <select class="form-control selectpicker" data-live-search="true" style="width:100%;" required name="day_id[]">
                                    @foreach($days as $day)
                                    <option value="{{$day->id}}">{{$day->name_ar}}</option>
                                    @endforeach
                                  </select>
                                </div>
                                <div class="col-3">
                                  
                                <label for="time1">من</label>
                             <input type="time" id="time1" name="from_time[]" class="form-control" required="required">
                                                              
                                    </div>
                                <div class="col-3">
                                   
                                <label>الى </label>
                                <input type="time" name="to_time[]" class="form-control" required="required">
                                               
                                    </div>
                                <div class="col-3">
                            <div class="optionz">              
                               <span class="text-center" id="app-btn12" style="  cursor:pointer;" ><i class="fas fa-plus"></i></span>
                                
                            </div>

                        </div>
                                

                        

                            </div>
                                    @endif

</section>
                        <div class="save text-center mt-6">
                            <div class="row save">
                                <div class="col-12 text-center">
                                  <input type="submit"  value="حفظ"  style="cursor:pointer;" class="text-center">
                                </div>
                            </div>
                        </div>
                         </div>
                  </form>
                    </div>
                </div>
            </div>
             <!--</form>-->
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
@section("scripts")
<script>
let c = 1;
$("#app-btn12").click(function(){
  $("#section").append(`<div class="row" id="c${c}">
                                <div class="col-3">
                                  <label >اليوم</label>
                                  <select class="form-control selectpicker" data-live-search="true" style="width:100%;" required name="day_id[]">
                                    @foreach($days as $day)
                                    <option value="{{$day->id}}">{{$day->name_ar}}</option>
                                    @endforeach
                                  </select>
                                </div>
                                <div class="col-3">
                                  
                                <label for="time1">من</label>
                             <input type="time" id="time1" name="from_time[]" class="form-control" required="required">
                                                              
                                    </div>
                                <div class="col-3">
                                   
                                <label>الى </label>
                                <input type="time" name="to_time[]" class="form-control" required="required">
                                               
                                    </div>
                                <div class="col-3">
                            <div class="optionz" onclick="removerow(${c})" >              
                               <span class="text-center fe"  ><i class="fas fa-times" style="margin-right:4px;"></i></span>
                                
                            </div>

                        </div>
                                

                            </div>`);
  $(".selectpicker").selectpicker("refresh");
  c++;
});
  function removerow(c){
    $(`#c${c}`).remove();
    c--;
  }

</script>
  @endsection