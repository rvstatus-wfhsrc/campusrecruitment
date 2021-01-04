function renderBarChart(chartData, labels) {
  var ctx = document.getElementById("myBarChart");
  var myLineChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [{
        label: "Token",
        backgroundColor: "rgba(2,117,216,1)",
        borderColor: "rgba(2,117,216,1)",
        data: chartData,
      }],
    },
    options: {
      scales: {
        xAxes: [{
          time: {
            unit: 'month'
          },
          gridLines: {
            display: false
          },
          ticks: {
            maxTicksLimit: 6
          }
        }],
        yAxes: [{
          ticks: {
            min: 0,
            max: 50,
            maxTicksLimit: 10
          },
          gridLines: {
            display: true
          }
        }],
      },
      legend: {
        display: false
      }
    }
  });
}
// To get and assign the data
function getBarChartData() {   
  $.ajax({
    url: 'companyBarChart',
    type: 'GET',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    dataType: 'json',
    success: function (resp) {
      // alert(JSON.stringify(resp));
      var data = [];
      var labels = [];
      for (var i in resp) {
        data.push(resp[i].count);
        labels.push(resp[i].month);
      }
      renderBarChart(data, labels);
    },
    error: function (data) {
      console.log(data);
    }
  });
}
$(document).ready(function(){
  getBarChartData();
});