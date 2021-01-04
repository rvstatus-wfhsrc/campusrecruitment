function renderPieChart(chartData) {
	var ctx = document.getElementById("myPieChart");
	var myPieChart = new Chart(ctx, {
    type: 'pie',
  	data: {
      labels: [ "Applied", "Passed", "Failed"],
      datasets: [{

        data: chartData,
        backgroundColor: ['#007bff', '#28a745', '#dc3545'],
    	}],
  	},
    options: {
      legend: {
        labels: {
          boxWidth: 16
        }
      }
    }
	});
}
// To get and assign the data
function getPieChartData() {
  	$.ajax({
    	url: 'adminPieChart',
    	type: 'GET',
    	headers: {
      		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    	},
    	dataType: 'json',
    	success: function (resp) {
      		// alert(JSON.stringify(resp));
      		var data = [];
      		for (var i in resp) {
        		data.push(resp[i].count);
      		}
      		renderPieChart(data);
    	},
    	error: function (data) {
      		console.log(data);
    	}
  	});
}
$(document).ready(function(){
  	getPieChartData();
});
