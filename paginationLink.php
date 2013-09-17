<?php
	$adjacents = 5;
	$limit = 20;

	if ($page == 0)
	{
		$page = 1;					//if no page var is given, default to 1.
	}
	
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
		
	$pagination = "";
	
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\"><ul>";
		//previous button
		if ($page > 1) 
			$pagination.= "<li><a href=\"$targetpage?page=$prev$moreVar\"><< previous</a></li>";
		else
			$pagination.= "<li><span class=\"disabled\"><< previous</span></li>";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<li><span class=\"current\">$counter</span></li>";
				else
					$pagination.= "<li><a href=\"$targetpage?page=$counter$moreVar\">$counter</a></li>";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li><span class=\"current\">$counter</span></li>";
					else
						$pagination.= "<li><a href=\"$targetpage?page=$counter$moreVar\">$counter</a></li>";					
				}
				$pagination.= "<li>...</li>";
				$pagination.= "<li><a href=\"$targetpage?page=$lpm1$moreVar\">$lpm1</a></li>";
				$pagination.= "<li><a href=\"$targetpage?page=$lastpage$moreVar\">$lastpage</a></li>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<li><a href=\"$targetpage?page=1$moreVar\">1</a></li>";
				$pagination.= "<li><a href=\"$targetpage?page=2$moreVar\">2</a></li>";
				$pagination.= "<li>...</li>";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li><span class=\"current\">$counter</span></li>";
					else
						$pagination.= "<li><a href=\"$targetpage?page=$counter$moreVar\">$counter</a></li>";					
				}
				$pagination.= "<li>...</li>";
				$pagination.= "<li><a href=\"$targetpage?page=$lpm1$moreVar\">$lpm1</a></li>";
				$pagination.= "<li><a href=\"$targetpage?page=$lastpage$moreVar\">$lastpage</a></li>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<li><a href=\"$targetpage?page=1$moreVar\">1</a></li>";
				$pagination.= "<li><a href=\"$targetpage?page=2$moreVar\">2</a></li>";
				$pagination.= "<li>...</li>";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li><span class=\"current\">$counter</span></li>";
					else
						$pagination.= "<li><a href=\"$targetpage?page=$counter$moreVar\">$counter</a></li>";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<li><a href=\"$targetpage?page=$next$moreVar\">next >></a></li>";
		else
			$pagination.= "<li><span class=\"disabled\">next >></span></li>";
		$pagination.= "</div>\n";		
	}

	echo $pagination;
?>