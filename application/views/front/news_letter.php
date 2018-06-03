<table width="100%" border="1" cellpadding="3" cellspacing="0">
	<tr>
    	<th>Job Title</th>
        <th>Category</th>
        <th>Date</th>
    </tr>
    <? foreach($jobs as $job): 
		
	?>
    <tr>
    	<td><a href="<?=BASE_URL.$job['url']?>"><?=$job['name']?></a></td>
        <td>&nbsp;</td>
        <td><?=$this->general_lib->show_date($job['ad_date'])?></td>
    </tr>
    <? endforeach; ?>
</table>