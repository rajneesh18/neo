<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neo Soft APP</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        body {
          margin: 3rem
        }
        .fixed-height-chart {
          height: 200px
          border: 1px solid black
        }
    </style>
</head>
<body>
    <div class="container">
        
        <div class="row" style="margin-top: 20px;margin-bottom: 20px;">
            
		    <h3>Asteroid - Neo Stats</h3>
            <form name="search-form" method="get" action="{{ url('/') }}">
    			@csrf
    			<div class="row">
    			    
    			<div class="col-md-4 form-group">
    				<label for="from">From Date</label>
    				<input type="date" name="from" id="from" class="form-control" value="{{ $_REQUEST['from'] ?? '' }}" required/>
    			</div>
    			
    			<div class="col-md-4 form-group">
    				<label for="to">To Date</label>
    				<input type="date" name="to" id="to" class="form-control" value="{{ $_REQUEST['to'] ?? '' }}" required/>
    			</div>
      
    			
    			<div class="col-md-4 form-group">
    			    
    				<label for="to">&nbsp;</label>
    				<input type="submit" name="submit" class="form-control btn btn-primary" value="Search" />
    			</div>
    			
    			</div>
    		</form>
		
		</div>
		
		<div class="row">
			<div>
				<div>Fastest Astroid (km/h): {{ $maxspeed }}</div>
			</div>
			
			<div>
				<div>Closest Astroid: </div>
			</div>
			
			<div>
				<div>Average Size of Astroid (Km): </div>
			</div>
		</div>
		
		
		<div class="fixed-height-chart">
			<canvas id="myChart"></canvas>
		</div>
		
    </div>
	
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js"> </script>
    
<script>
  const labels = [ <?= $graph_key ?> ];

  const data = {
    labels: labels,
    datasets: [{
      label: 'Astroids Data',
      backgroundColor: 'rgb(255, 99, 132)',
      borderColor: 'rgb(255, 99, 132)',
      data: [ {{ implode(',', $graph_value) }} ],
    }]
  };

  const config = {
    type: 'line',
    data: data,
    options: {
        maintainAspectRatio: false,
    }
  };
</script>
<script>
  const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>



</body>
</html>