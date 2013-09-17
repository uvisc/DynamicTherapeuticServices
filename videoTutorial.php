<?php
	//session_start();
	$pageTitle = "Video Tutorial";

	include_once('include/header.php');
?>
						<div class="row-fluid">
<?php	

	if ($maintenancePeriod[0][0] == "Y")
	{
?>							<div class="hero-unit">
								<div class="container">
									<h1>Alert/Notification</h1>
									<p class="lead">System down or any related notification.</p>
								</div>
							</div>
<?php
	}
?>
							<div class="span12">
								<div class="row-fluid navbar">
									<div class="span12" align="center">
										<a href="#" class="brand">Welcome to Dynamic Therapeutic Services Video Tutorial</a>
									</div>
								</div>
								<div class="row-fluid" style="border: 1px solid #000;">
									<div class="span4" align="left">
										<ul class="menuCategory">
<?php
	$cntMenuCategories = $menuClass->cntMenuCategory();

	if ($cntMenuCategories > 0)
	{
		$menuCatID = array();
		$i = 0;
		$menuCategories = $menuClass->menuCategories();

		$newMenuCategories = array_filter($menuCategories);
       	
       	if (!empty($newMenuCategories))
       	{
       		foreach ($menuCategories as $menuCat)
       		{
?>						            	
							                <li id="menuCategoryLi"><p class="menuCat"><?php echo $menuCat[1]; ?></p>
<?php
				$cntMenu = $menuClass->cntMenu($menuCat[0]);

				if ($cntMenu > 0)
				{
?>
												<ul>
<?php
					$getMenu = $menuClass->getMenu($menuCat[0]);

					foreach($getMenu as $rowMenu)
					{
?>
													<li><a class="menuTextVideo" id="menuTextVideo" href="#" onclick="loadVideo('<?php echo $rowMenu[1]; ?>', '<?php echo $rowMenu[4]; ?>')"><?php echo $rowMenu[1]; ?></a></li>
<?php
					}
?>
												</ul>
<?php
				}
?>
											</li>
<?php
			}
		}
	}
?>
						            	</ul>
								    </div>    
								    <div class="span8" align="center" class="videoFrame">
								    	<div class="row-fluid" id="videoFrame">Please select a menu from left to view the tutorial video.</div>
								    	<div class="row-fluid">
								    		<figure>
								    			<iframe id="youtubeVideo" class="youtube-player" type="text/html" width="640" height="385" allowfullscreen frameborder="0"></iframe>
								    		</figure>
								    	</div>
								    </div>
								</div>
							</div>
						</div>
<?php
	include_once('include/footer.php');
?>		