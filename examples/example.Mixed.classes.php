<?php   
/* CAT:Combo */

/* pChart library inclusions */
require_once("bootstrap.php");

use pChart\{
	pDraw,
	pIndicator,
	pCharts
};

/* Create the pChart object */
$myPicture = new pDraw(700,350);

/* Populate the pData object */
for($i=0;$i<=80;$i++) {
	$myPicture->myData->addPoints(($i/10)*($i/10),"Statistical probability"); 
}
$myPicture->myData->setAxisName(0,"Probability");
$myPicture->myData->setAxisUnit(0,"%");

/* Turn off Anti-aliasing */
$myPicture->Antialias = FALSE;

/* Draw the background */
$Settings = array("R"=>170, "G"=>183, "B"=>87, "Dash"=>1, "DashR"=>190, "DashG"=>203, "DashB"=>107);
$myPicture->drawFilledRectangle(0,0,700,350,$Settings);

/* Overlay with a gradient */
$Settings = array("StartR"=>219, "StartG"=>231, "StartB"=>139, "EndR"=>1, "EndG"=>138, "EndB"=>68, "Alpha"=>50);
$myPicture->drawGradientArea(0,0,700,220,DIRECTION_VERTICAL,$Settings);
$Settings = array("StartR"=>1, "StartG"=>138, "StartB"=>68, "EndR"=>219, "EndG"=>231, "EndB"=>239, "Alpha"=>50);
$myPicture->drawGradientArea(0,222,700,350,DIRECTION_VERTICAL,$Settings);

/* Add a border to the picture */
$myPicture->drawRectangle(0,0,699,349,["R"=>0,"G"=>0,"B"=>0]);

/* Set the default font */
$myPicture->setFontProperties(array("FontName"=>"pChart/fonts/pf_arma_five.ttf","FontSize"=>6));

/* Define the chart area */
$myPicture->setGraphArea(60,40,650,200);

/* Draw the scale */
$scaleSettings = array("XMargin"=>10,"YMargin"=>10,"Floating"=>TRUE,"LabelSkip"=>4,"GridR"=>220,"GridG"=>220,"GridB"=>220,"DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE);
$myPicture->drawScale($scaleSettings);

/* Turn on Anti-aliasing */
$myPicture->Antialias = TRUE;

/* Draw the line of best fit */
$myPicture->drawBestFit(["Ticks"=>4,"Alpha"=>50,"R"=>0,"G"=>0,"B"=>0]);

/* Draw the line chart */
$myCharts = new pCharts($myPicture);
$myCharts->drawLineChart();

/* Draw the series derivative graph */
$myCharts->drawDerivative(["ShadedSlopeBox"=>TRUE,"CaptionLine"=>TRUE]);

/* Write the chart legend */
$myPicture->drawLegend(570,20,["Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL]);

/* Set the default font & shadow settings */
$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));
$myPicture->setFontProperties(array("FontName"=>"pChart/fonts/Forgotte.ttf","FontSize"=>11));

/* Write the chart title */ 
$myPicture->setFontProperties(array("FontName"=>"pChart/fonts/Forgotte.ttf","FontSize"=>11));
$myPicture->drawText(150,35,"Probability of heart disease",["FontSize"=>20,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE,"R"=>255,"G"=>255,"B"=>255]);

/* Write a label over the chart */
$LabelSettings = array("DrawVerticalLine"=>TRUE,"TitleMode"=>LABEL_TITLE_BACKGROUND,"TitleR"=>255,"TitleG"=>255,"TitleB"=>255);
$myPicture->writeLabel("Statistical probability",35,$LabelSettings);

/* Create the pIndicator object */ 
$Indicator = new pIndicator($myPicture);

/* Define the indicator sections */
$IndicatorSettings = [
	"Values"=>35,
	"Unit"=>"%",
	"CaptionPosition"=>INDICATOR_CAPTION_BOTTOM,
	"CaptionR"=>0,
	"CaptionG"=>0,
	"CaptionB"=>0,
	"DrawLeftHead"=>FALSE,
	"ValueDisplay"=>INDICATOR_VALUE_LABEL,
	"ValueFontName"=>"pChart/fonts/Forgotte.ttf",
	"ValueFontSize"=>15,
	"IndicatorSections"=> [
			array("Start"=>0,"End"=>29,"Caption"=>"Low","R"=>0,"G"=>142,"B"=>176),
			array("Start"=>30,"End"=>49,"Caption"=>"Moderate","R"=>108,"G"=>157,"B"=>49),
			array("Start"=>50,"End"=>80,"Caption"=>"High","R"=>226,"G"=>74,"B"=>14),
		]
];

$Indicator->draw(60,275,580,30,$IndicatorSettings);

/* Render the picture (choose the best way) */
$myPicture->autoOutput("temp/example.mixed.png");

?>