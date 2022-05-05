<?php
include_once "./include/utils.inc.php";
require_once "./jpgraph/jpgraph.php";
require_once "./jpgraph/jpgraph_bar.php";

$visited_tracks = get_visited_track();

$theme = get_theme();

$datay=[];
$datax=[];

foreach ($visited_tracks as $key => $value) {
    array_push($datax, $key);
    array_push($datay, $value);
}

// Create the graph. These two calls are always required
$graph = new Graph(1000,500,'auto');
$graph->SetScale("textlin");

//$theme_class="DefaultTheme";
//$graph->SetTheme(new $theme_class());

// set major and minor tick positions manually
//$graph->yaxis->SetTickPositions(array(0,30,60,90,120,150), array(15,45,75,105,135));
$graph->SetBox(false);

//$graph->ygrid->SetColor('gray');
$graph->ygrid->SetFill(false);
$graph->xaxis->SetTickLabels($datax);
$graph->yaxis->HideLine(true);
$graph->yaxis->HideTicks(false,false);

// Create the bar plots
$b1plot = new BarPlot($datay);

// ...and add it to the graph
$graph->Add($b1plot);

$b1plot->SetColor("red");
$b1plot->SetFillColor("#FF0000");
$b1plot->SetWidth(20);

$graph->title->Set("Titres les plus visités");

if ($theme == "light") {
    $graph->SetBackgroundGradient('#f3f3f3', '#f3f3f3', GRAD_HOR, BGRAD_PLOT);
    $graph->SetMarginColor('#f3f3f3'); 
    $graph->SetFrame(true, '#f3f3f3',1); 
    $graph->title->SetColor('#000000');
    $graph->xaxis->SetColor('#000000');
    $graph->yaxis->SetColor('#000000');
    
}
else {
    $graph->SetBackgroundGradient('#202020', '#202020', GRAD_HOR, BGRAD_PLOT);
    $graph->SetMarginColor('#202020'); 
    $graph->SetFrame(true,'#202020',1); 
    $graph->title->SetColor('#f0f0f0');
    $graph->xaxis->SetColor('#f0f0f0');
    $graph->yaxis->SetColor('#f0f0f0');
}

// Display the graph
$graph->Stroke(GRAPH_PATH);
