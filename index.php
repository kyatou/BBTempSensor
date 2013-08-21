<?php



	//display templog for 3 days
	$days=3;
	$today=date("Ymd");
	$yesterday=date("Ymd",strtotime('-1 day'));

	$imagedir="graphimages/";

	if(false==file_exists($imagedir))
	{
		die("imagedir not found.($imagedir)");
	}

	//show graphimages
	for($i=0;$i<$days;$i++)
	{
		$logdate=date("Ymd",strtotime("-$i day"));
		$imgtag="<img src='$imagedir$logdate.png'/><br>";
		print "$imgtag";
	}

	if ($dir = opendir("graphimages/"))
	{
		while (($file = readdir($dir)) !== false)
		 {	if ($file != "." && $file != "..")
			 	{
            echo "$file\n";
        }
    } 
	
    closedir($dir);
	}
?>
