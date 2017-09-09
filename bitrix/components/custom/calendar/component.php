<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$format="m.Y";

$date_now=($_REQUEST['date'])? $_REQUEST['date'] : date($format);

$date_time_now=strtotime("01.".$date_now);
$date_time_last=strtotime("last Month", $date_time_now);
$date_time_next=strtotime("next Month", $date_time_now);


$arResult['PREV']=date($format,$date_time_last);
$arResult['NEXT']=date($format,$date_time_next);
$arResult['NOW']=$date_time_now;



$dayofmonth = date('t', $date_time_now);
$dayofmonth_last = date('t', $date_time_last);

$day_count = 1;


$num = 0;

for($i = 0; $i < 7; $i++)
{
	$dayofweek = date('w', mktime(0, 0, 0, date('m', $date_time_now), $day_count, date('Y',$date_time_now)));
	$dayofweek = $dayofweek - 1;
	if($dayofweek == -1) $dayofweek = 6;
	if($dayofweek == $i)
	{
	  $week[$num][$i]['value'] = $day_count;
	  $week[$num][$i]['value_date']=$day_count.".".$date_now;
	  $day_count++;
	}
	else
	{
		$n=$dayofweek-$i-1;
		$dd=strtotime($dayofmonth_last.date(".m.Y", $date_time_last));
		$week[$num][$n]['value'] =date("j", $dd);
		$week[$num][$n]['value_date']=date("j.m.Y", $dd);
		$week[$num][$n]['off']=1;
		$dayofmonth_last--;
	}
}

while(true)
{
	$num++;
	for($i = 0; $i < 7; $i++)
	{
		if($day_count < $dayofmonth)
		{
			$week[$num][$i]['value'] = $day_count;
			$week[$num][$i]['value_date']=$day_count.".".$date_now;
		}else
		{ 
			$d_next++;
			$dd=strtotime($d_next.date(".m.Y", $date_time_next));
			$week[$num][$i]['value'] = date("j", $dd);
			$week[$num][$i]['value_date']=date("j.m.Y", $dd);
			$week[$num][$i]['off']=1;
		}
		$day_count++;
	}

	if($day_count > $dayofmonth) break;
}

$arResult['week']=$week;











$this->includeComponentTemplate();
