<div class="col-md-5">
  <div class="row row-sm text-center">
    <div class="col-xs-6">
      <a href="{{route('triage-vitals')}}" class="block panel padder-v @if(count($triages)>0) bg-danger @else bg-info @endif item dker">
        <span class="text-white font-thin h1 block">{{ count($triages) }}</span>
        <span class="text-muted text-xs">Pending</span>
      </a>
    </div>
    <div class="col-xs-6">
      <a href="{{route('triage-vitals')}}" class="block panel padder-v @if(!count($medical_certificates)) bg-info @else bg-danger @endif item dker">
        <span class="text-white font-thin h1 block">{{ count($medical_certificates) }}</span>
        <span class="text-muted text-xs">Certificate</span>
      </a>
    </div>
    <div class="col-xs-6">
      <a href="{{route('activities')}}" class="block panel padder-v bg-info item dker">
        <span class="text-white font-thin h1 block"><i class="fa fa-line-chart"></i></span>
        <span class="text-muted text-xs">Activities</span>
      </a>
    </div>
  </div>
</div>