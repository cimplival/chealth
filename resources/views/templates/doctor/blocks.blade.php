<div class="col-md-5">
  <div class="row row-sm text-center">

    <div class="col-xs-6">
      <a href="{{route('doctor-appointments')}}" class="block panel padder-v @if(count($examinations)>0) bg-danger @else bg-info @endif item dker">
        <span class="text-white font-thin h1 block">{{ count($examinations) }}</span>
        <span class="text-muted text-xs">Pending</span>
      </a>
    </div>
    <div class="col-xs-6">
    <a href="{{ route('medical-profile') }}" class="block panel padder-v @if($examination) bg-danger @else bg-info @endif item dker">
        <span class="text-white font-thin h1 block"> 
          @if($examination)
            <i class="fa fa-check"></i> 
          @else 
            0 
          @endif</span>
        <span class="text-muted text-xs">Examination</span>
      </a>
    </div>

    <div class="col-xs-6">
      <a href="" class="block panel padder-v bg-info item dker">
        <span class="text-white font-thin h1 block">5</span>
        <span class="text-muted text-xs">Today's Patients</span>
      </a>
    </div>
    <div class="col-xs-6">
      <a href="{{ route('activities') }}" class="block panel padder-v bg-info item dker">
        <span class="text-white font-thin h1 block"><i class="fa fa-line-chart"></i></span>
        <span class="text-muted text-xs">Activity</span>
      </a>
    </div>
  </div>
</div>