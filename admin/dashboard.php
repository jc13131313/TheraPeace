<?php

session_start();

include '../database/database.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to the login page
    header('location: ../index.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="icon" href="../pictures/logo-circle.png">

    <script type="text/javascript">
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	theme: "light1", // "light2", "dark1", "dark2"
	animationEnabled: false, // change to true		
	title:{
		text: "RATINGS"
	},
	data: [
	{
		// Change type to "bar", "area", "spline", "pie",etc.
		type: "column",
		dataPoints: [
			{ label: "Tañedo Psychological Services",  y: 45  },
			{ label: "Argao Center for Psychological Services", y: 47  },
			{ label: "Hospital V.L. Makabali Memorial, Inc.", y: 26  },
			{ label: "Joseph Gene G. Ponio Psychiatry Clinic",  y: 28  },
			{ label: "AMT Psych Consult Clinic",  y: 41  }
		]
	}
	]
});
chart.render();

}
</script>
<style>
    #container {
  min-width: 310px;
  height: 400px;
  max-width: 600px;
  margin: 0 auto;
}
</style>
</head>

<body>
    <div class="menu-wrapper">
        <div class="sidebar-header">
            <div class="sideBar">
                <div><img src="../pictures/logo-picture.png" /></div>
                <ul>
                <a href="../admin/dashboard.php"><li class="sidebar-item selected" data-content="dashboard"><i class="fas fa-chart-bar"></i><label>Dashboard</label></li></a>
                    <a href="../admin/admin-profile.php"><li class="sidebar-item" data-content="adminprofile"><i class="fas fa-user"></i><label>Admin Profile</label></li></a>
                </ul> <span class="cross-icon"><i class="fas fa-times"></i></span>
            </div>
            <div class="backdrop"></div>
            <div class="content">
                <header>
                    <div class="menu-button" id='desktop'>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                    <div class="menu-button" id='mobile'>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                    <div class="dropdown">
                    <i class="bi bi-person-circle" style="font-size: 40px;"></i>
                    <div class="dropdown-content">
                    <a href="../logout.php" style="color: black;"><i class="bi bi-box-arrow-right" style="margin-right: 5px;"></i>Log Out</a> 
                 </div>
                </div>
                </header>
                <div class="content-data">
                    <div id="Dashboard-content" style="display: flex;">
                    <div id="chartContainer" style="height: 100%; width: 50%;"></div>
                    <div id="container"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/admin-page.js"></script>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"> </script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
    Highcharts.chart('container', {
  colors: [' #BF2533', '#004AAD', '#008631'],
  chart: {
    type: 'pie'
  },
  title: {
    text: 'VISIT SEPARATION'
  },
  tooltip: {
    valueSuffix: '%'
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '{point.name}: {y} %'
      },
      showInLegend: true
    }
  },
  series: [{
    name: 'Percentage',
    colorByPoint: true,
    innerSize: '75%',
    data: [{
      name: 'Mobile',
      y: 50
    }, {
      name: 'Desktop',
      y: 40
    }, {
      name: 'Laptop',
      y: 10
    }]
  }]
});
</script>
</body>

</html>
