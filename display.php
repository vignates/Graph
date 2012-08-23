<?php
ini_set('display_erors',1);
include_once 'style.php';
require_once 'phplot/phplot.php';
if(!empty($_REQUEST['phone_name'])) {
   $score=$_REQUEST['check_list'];
   $name=array_values(array_filter($_REQUEST['phone_name']));
   $data = array();
   //print_r($result);
 for($i=0;$i<count($score);$i++)
{
	$data[]=array($name[$i],$score[$i]);
}
} 
//print_r($data);exit;
 //$data=conn();
 $plot = new PHPlot(574, 432);
//$plot->SetIsInline(True);
$plot->SetBgImage('watermark.png', 'scale');
//$plot->SetPlotAreaBgImage('Veuqs.png', 'scale');
//$plot->SetPlotAreaPixels(NULL, NULL, 574, 432);
$plot->SetImageBorderType('plain'); // Improves presentation in the manual
$plot->SetTitle("Samsung Galaxy S3 AntTuTu Comparison");
$plot->SetBackgroundColor('#ffffff');
$plot->SetPlotAreaWorld(0);
$plot->SetTTFPath('./phplot');
// No ticks along Y axis, just bar labels:
$plot->SetYTickPos('none');
//  No ticks along X axis:
$plot->SetXTickPos('xaxis');
// No X axis labels. The data values labels are sufficient.
$plot->SetXTickLabelPos('xaxis');
// Turn on the data value labels:
$plot->SetXDataLabelPos('plotin');
//$plot->SetXDataLabelAngle(90);
$plot->SetPrecisionX(0);
$plot->SetNumberFormat('', '');
//$plot->SetTransparentColor('#FFCC00');
$plot->SetFontTTF('title', 'arial.ttf', 14);
$plot->SetFontTTF('y_label', 'arial.ttf', 10);
$plot->SetFontTTF('x_label', 'arial.ttf', 8);
$plot->SetDataValueLabelColor('#ffffff');
//No grid lines are needed:
$plot->SetDrawXGrid(true);
//$plot->SetLegend(array('quadrant','antutu','example'));
$plot->SetCallback('data_color', 'pickcolor', $data);
// Set the bar fill color:
$plot->SetDataColors(array('#FFCC00','#33AACC'));
// Use less 3D shading on the bars:
$plot->SetShading(10);
$plot->SetDataValues($data);
$plot->SetDataType('text-data-yx');
//$plot->SetPlotType('stackedbars');
$plot->SetPlotType('bars');
$val=rand(1,10);
//$plot->SetOutputFile('images/sample'.$val.'.png');
$plot->SetPrintImage(False);
$plot->DrawGraph(); 

?>
<div class="row">
<div class="span12" style="text-align:center">
<?php
function pickcolor($img, $data_array, $row, $col)
{
$current_phone = $data_array[$row][0];
if ($current_phone == "Galaxy SII") return 0;
return 1;
}
echo "<img src=\"" . $plot->EncodeImage() . "\">\n";
?>
</div></div>
</div>