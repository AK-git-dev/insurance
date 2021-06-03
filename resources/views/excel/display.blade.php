<html>
<head>
    <title>Insurance</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
</head>
<body>
  
<div class="container" style="margin-top: 5rem;">
    @if($message = Session::get('success'))
        <div class="alert alert-info alert-dismissible fade in" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          <strong>Success!</strong> {{ $message }}
        </div>
    @endif
    {!! Session::forget('success') !!}
	<h1>Excel upload data</h1>
    <table  class="table table-bordered table-striped">
        <th>Poilcy</th>
        <th>Location</th>
        <th>Region</th>
        <th>Insured Value</th>
        <th>Business Type</th>
        @if(count($data)>0)
        @foreach($data as $d)
        <tr>
            
            <td>
                {{$d->policy}}
            </td>
            <td>
                {{$d->location}}
            </td>
            <td>
                {{$d->region}}
            </td>
            <td>
                {{$d->insuredvalue}}
            </td>
            <td>
                {{$d->businesstype}}
            </td>

        </tr>
        @endforeach
        @else
        <tr>
            <td>
                No data Found
            </td>
        </tr>
        @endif
    </table>
    <label for="search">Select the Search</label>
    <form id="searchdata" method="post" style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ route('displaydata') }}" class="form-horizontal">
 @csrf
<select name="search" id="search" onchange="submit();">
  <option value="">select</option>
  <option @if($search=="Policy")  selected @endif value="Policy">Policy</option>
  <option @if($search=="Location")  selected @endif value="Location">Location</option>
  <option @if($search=="region")  selected @endif value="region">region</option>
  <option @if($search=="businesstype")  selected @endif value="businesstype">BusinessType</option>
</select>
</form>
    <div id="container3"></div>
    <div id="container4"></div>
   
</div>
   
</body>


<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
    var users =  <?php echo json_encode($user) ?>;
    var u =  <?php echo json_encode($visitors) ?>;
    var region =  <?php echo json_encode($region) ?>;
   
    Highcharts.chart('container3', {
        title: {
            text: 'first graph'
        },
        subtitle: {
            text: 'Source: insurance'
        },
         xAxis: {
            categories: u
        },
        yAxis: {
            title: {
                text: 'Number of Insurance'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'Amount',
            data: users
        },{
            name: 'Policy',
            data: u
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
});



Highcharts.chart('container4', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'second graph'
    },
    subtitle: {
        text: 'demo2'
    },
    xAxis: {
        categories: region,
        title: {
            text: null
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Population (millions)',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: ' millions'
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
       
        floating: true,
        borderWidth: 1,
        backgroundColor:
            Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
        shadow: true
    },
  
    series: [{
        name: region,
        data: users
    }]
});
      
function submit(){
    $('#searchdata').submit();
}
</script>
</html>