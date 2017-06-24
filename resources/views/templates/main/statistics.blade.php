<div class="col-md-7">
  <div class="panel wrapper">
    <h4 class="font-thin m-t-none m-b text-muted">Appointments</h4>
    <div ui-jq="plot" ui-refresh="showSpline" ui-options="
    [
      { data: [[0,{{$appointments6}}],[1,{{$appointments5}}],[2,{{$appointments4}}],[3,{{$appointments3}}],[4,{{$appointments2}}],[5,{{$appointments1}}],[6,{{$appointments0}}]], bars: {align: 'center', show: true, barWidth: 0.7, fillColor: { colors: [{ opacity: 0.2 }, { opacity: 0.4}] }, points: { show: true, radius: 6} } }
    ], 
    {
    colors: ['#23b7e5', '#7266ba'],
    series: { shadowSize: 3 },
    xaxis:{ font: { color: '#a1a7ac' },
    position: 'bottom',
    ticks: [
      [ 0, '{{$date6}}' ], [ 1, '{{$date5}}' ], [ 2, '{{$date4}}' ], [ 3, '{{$date3}}' ], [ 4, '{{$date2}}' ], [ 5, 'Yesterday' ], [ 6, 'Today' ]
      ]  
    },
    yaxis:{ font: { color: '#a1a7ac' }, min:0, tickDecimals: 0},
    grid: { hoverable: true, clickable: false, borderWidth: 0, color: '#dce5ec' },
    tooltip: true,
    tooltipOpts: { content: '%y appointments',  defaultTheme: false, shifts: { x: 10, y: -25 } }
  }
  " style="height:246px">
</div>
</div>
</div>