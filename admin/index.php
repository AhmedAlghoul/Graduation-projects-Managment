
<?php
$page_title = "الصفحة الرئيسية";
require "../includes/head.php";
if((isset($_SESSION['uname']) && isset($_SESSION['token']))){
  if($_SESSION['level'] ==1){
?> 
    <!-- Page Content -->
    <div id="page-content-wrapper  Sidebar_r" style="width: 100%;">

    <?php

require "../includes/nav.php";
?> 

      <div class="container-fluid">
	  <div class="container">
        <h1 class="mt-4 text-center"> الصفحة الرئيسية</h1>

<script>
window.onload = function () {
	
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	
	title:{
		text:"المشاريع"
	},
	axisX:{
		interval: 1
	},
	axisY2:{
		interlacedColor: "rgba(1,77,101,.2)",
		gridColor: "rgba(1,77,101,.1)",
		title: "عدد الطلاب"
	},
	data: [{
		type: "bar",
		name: "Students",
		axisYType: "secondary",
		color: "#563d7c",
		dataPoints: [
			{ y: 2, label: " المشروع رقم 1" },
			{ y: 4, label: " المشروع رقم 2" },
			{ y: 2, label: "المشروع رقم 3" },
			{ y: 3, label: "المشروع رقم 4" },
			{ y: 4, label: "المشروع رقم 5" },
			{ y: 2, label: "المشروع رقم 6" },
			{ y: 2, label: "المشروع رقم 7" },
			{ y: 4, label: "المشروع رقم 8" },
			
		
		]
	}]
});
chart.render();

}
</script>

<div id="chartContainer" style="height: 300px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<style>
.canvasjs-chart-container{
    text-align: right !important;
}
</style>


      </div>
      </div>
<?php
      require "../includes/c_footer.php";
	}
					 }else{
						header('Location: '."../login.php");
					
					}
					 //else redirect to login page
		?>
