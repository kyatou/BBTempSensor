<?php
	ini_set('display_errors',1);
	
	//Standardinclusions
	include("pChart/pData.class");
	include("pChart/pChart.class");
	
	$fontPath="Fonts/tahoma.ttf";
	//Datasetdefinition
	$DataSet=new pData;

	//filename,delimiter,datacolumns,hasHeader,DataName
	//skip 1,3 column
	$targetdate=date("Ymd");   
	if(	isset($_GET['date']))
	{
		$targetdate=$_GET['date'];
	}	
	
	$logfilename="logfiles/$targetdate.csv";
	if (false== file_exists($logfilename))
	{
		die("$logfilename not exists.");
	}

	//ignore sensor ain0,ain1
	$DataSet->ImportFromCSV($logfilename,",",array(2,3,4,5,6,7),FALSE,0);
	$DataSet->AddAllSeries();
	$DataSet->SetAbsciseLabelSerie();
	$DataSet->SetYAxisName("Room Temp");
	$DataSet->SetYAxisUnit("`C");

	//Initialisethegraph
	$imgWidth=1000;
	$imgHeight=400;
	$yAxisAreaWidth=100;
	$xAxisAreaHeight=150;
	$Chart=new pChart($imgWidth,$imgHeight);
	$Chart->setFontProperties($fontPath,10);
	$Chart->setGraphArea($yAxisAreaWidth,50,$imgWidth-20,$imgHeight-$xAxisAreaHeight);

	//Graph outer background
	$Chart->drawFilledRoundedRectangle(7,7,$imgWidth-7,$imgHeight-7,5,240,240,240);
	$Chart->drawRoundedRectangle(5,5,$imgWidth-5,$imgHeight-5,5,230,230,230);

	//fill grapharea and draw X,Y axis
	$Chart->drawGraphArea(255,255,255,FALSE);// set true for stripe
	$skipLabel=count($DataSet->GetData())/20;
	$skipLabel=ceil($skipLabel);

	if($skipLabel<1) 
		$skipLabel=1;
	$Chart->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,150,150,150,TRUE,90,2,False,$skipLabel);

	//Drawthelinegraph
	$Chart->drawLineGraph($DataSet->GetData(),$DataSet->GetDataDescription());

	//Finishthegraph
	$Chart->setFontProperties("Fonts/tahoma.ttf",12);

	$Chart->drawTitle(0,0,"Temperature of my room  $targetdate",0,0,0,$imgWidth,50);//);//50,50,50,585);
	$imageName="graphimages/$targetdate.png";
	$Chart->Render($imageName);
	echo"<img src='$imageName'/>";

?>
