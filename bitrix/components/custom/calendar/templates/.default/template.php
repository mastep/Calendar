<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$week=$arResult['week'];
?>
<div class="container">
	<table class="calendar" border="0" cellpadding="0" cellspacing="0">
		<caption>
			<span class="prev" title="<?=GetMessage("prev")?>"><a href="?date=<?=$arResult['PREV']?>">←</a></span>
			<span class="next" title="<?=GetMessage("next")?>"><a href="?date=<?=$arResult['NEXT']?>">→</a></span>
			<?=GetMessage("MON".date("m",$arResult['NOW']))?> <?=date("Y",$arResult['NOW'])?>
		</caption>
		<thead>
			<tr>
				<th><?=GetMessage("DAY1")?></th>
				<th><?=GetMessage("DAY2")?></th>
				<th><?=GetMessage("DAY3")?></th>
				<th><?=GetMessage("DAY4")?></th>
				<th><?=GetMessage("DAY5")?></th>
				<th class="weekend"><?=GetMessage("DAY6")?></th>
				<th class="weekend"><?=GetMessage("DAY7")?></th>
			</tr>
		</thead>
			<tbody>
				<?
				foreach($week as $days)
				{
					$j=0;
					echo "<tr>";
					foreach($days as $day)
					{
						$j++;
						$url='?date='.$_REQUEST['date'].'&value='.$day['value_date'];
						if(!$day['off'])
						{
							if(in_array($j,array(6,7)))
							{
								echo '<td class="weekend"><a href="'.$url.'" value_date="'.$day['value_date'].'">'.$day['value'].'</a></td>';
							}else
							{
								echo '<td><a href="'.$url.'" value_date="'.$day['value_date'].'">'.$day['value'].'</a></td>';
							}
						}
						else
						{
							echo '<td class="off"><a href="'.$url.'" value_date="'.$day['value_date'].'">'.$day['value'].'</a></td>';
						}

					}

				echo "</tr>";

				} 
				?>
				<tr>
				<td colspan="7"><input id="day" name="day" value="<?=$_REQUEST['value']?>"></td>
				</tr>
			</tbody>
	</table>
</div>