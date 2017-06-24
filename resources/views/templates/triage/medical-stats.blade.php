<div class="col-md-7">
          <div class="panel wrapper">
            <h4 class="font-thin m-t-none m-b text-muted">Analytics</h4>
            <div ui-jq="plot" ui-refresh="showSpline" ui-options="
              [
                { data: [ [0,7],[1,6.5],[2,12.5],[3,7],[4,9],[5,6],[6,11],[7,6.5],[8,8],[9,7] ], label:'Visits', points: { show: true, radius: 1}, splines: { show: true, tension: 0.4, lineWidth: 1, fill: 0.8 } }
              ], 
              {
                colors: ['#23b7e5', '#7266ba'],
                series: { shadowSize: 3 },
                xaxis:{ font: { color: '#a1a7ac' } },
                yaxis:{ font: { color: '#a1a7ac' }, max:20 },
                grid: { hoverable: true, clickable: true, borderWidth: 0, color: '#dce5ec' },
                tooltip: true,
                tooltipOpts: { content: 'Visits of %x.1 is %y.4',  defaultTheme: false, shifts: { x: 10, y: -25 } }
              }
            " style="height:246px" >
            </div>
          </div>
        </div>
        