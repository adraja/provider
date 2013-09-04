<!DOCTYPE html>
<html>
<head>
<title> NuFitScan Customer History </title>


<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css" />
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
</head>
<body>

<img src="Nutriligence.png"/>

<div id="container" style="min-width: 1000px; height: 1000px; margin: 0 auto">
<?php
$userid = $_GET["userid"];
if (!isset($userid)){
	echo "No User set - Invalid operation<br />";
	return;
}
?>
</div><!-- /content -->

	<div data-role="footer">
	</div><!-- /footer -->


	</body>
	</html>

	<script>
$(function () {
	var colWidth = ($('#container').width() / 22 ) + 1;
	var userid = '<?php echo $userid; ?>';
	console.log ("user = " + userid + "\n");
	var url = "getcustomerhistory.php?userid="+userid;

	var obj;
	var dataArray1 = new Array();
	var colorArray1 = new Array();
	var labelArray1 = new Array();
	var jqxhr = $.get(url, function() {
		alert ("success");
	})
	.done(function(data){
			obj = JSON.parse(data);
			for( key in obj ) {
				if (key != 0){
					console.log("xaxis = "+obj[key].xaxis);
					console.log("yaxis = "+obj[key].yaxis);
					dataArray1.push([ Date(obj[key].xaxis), parseInt(obj[key].yaxis)]);
					var score = parseInt(obj[key].yaxis);
					var retcolor;
					console.log("score = "+score);
	if (score <= 13333){
		retcolor = '#F5CECE';
	}
	else if (score >= 13334 && score <= 16666){
		retcolor =  '#E06563';
	}
	else if (score >= 16667 && score <= 19999){
		retcolor =  '#FC0400';
	}
	else if (score >= 20000 && score <= 23333){
		retcolor =  '#FADE7C';
	}
	else if (score >= 23334 && score <= 26666){
		retcolor =  '#F0BB75';
	}
	else if (score >= 26667 && score <= 29999){
		retcolor =  '#CF8F06';
	}
	else if (score >= 30000 && score <= 33333){
		retcolor =  '#FCFCB6';
	}
	else if (score >= 33334 && score <= 36666){
		retcolor =  '#E4E45A';
	}
	else if (score >= 36667 && score <= 39999){
		retcolor =  '#FDFD02';
	}
	else if (score >= 40000 && score <= 43333){
		retcolor =  '#6ECC70';
	}
	else if (score >= 43334 && score <= 46666){
		retcolor =  '#04B404';
	}
	else if (score >= 46667 && score <= 49999){
		retcolor =  '#013D02';
	}
	else if (score >= 50000 && score <= 53333){
		retcolor =  '#79A4ED';
	}
	else if (score >= 53334 && score <= 56666){
		retcolor =  '#3C82FA';
	}
	else if (score >= 56667){
		retcolor =  '#08088A';
	}
					colorArray1.push(retcolor);
				}
			}

			console.log( dataArray1);
			console.log( colorArray1);

			$('#container').highcharts({
				chart: {
					type: 'column'
				},
				title: {
					text: 'Nutritional Health Assessment - History'
				},
				subtitle: {
					text: 'Carotenoid Scanner Score '
				},
				xAxis: {
					type: 'datetime'
				},
				yAxis: {
					min: 0,
						title: {
							text: 'Score'
						}
				},
					tooltip: {
						headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
							pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
							'<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
							footerFormat: '</table>',
							shared: true,
							useHTML: true
					},
					plotOptions: {
						column: {
							pointWidth: colWidth,
								colorByPoint: true,
								borderWidth: 1
						}
					},
					color: colorArray1,
					series: [{
						data: dataArray1
					}]
			}); //charts
	});
});

</script>
