<?php
	//session_start();
	$pageTitle = "Admin Panel";

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
										<a href="#" class="brand">Welcome to Dynamic Therapeutic Services Online Portal</a>
									</div>
								</div>
								<div class="row-fluid">
									<div class="span12" align="center">	
										<div id="horizontalTab">
						            		<ul class="resp-tabs-list">
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
       			$menuCatID[$i] = $menuCat[0];
       			$i++;
?>						            	
							                	<li><p class="menuCat"><?php echo $menuCat[1]; ?></p></li>
<?php
			}
		}
	}
?>
						            		</ul>
						            		<div class="resp-tabs-container">
						            			<div>
<?php
	$cntFavMenu = $menuClass->cntFavMenu();

	if ($cntFavMenu > 0)
	{
		$getFavMenu = $menuClass->getFavMenu();
?>
													<span>
<?php
		foreach($getFavMenu as $rowFavMenu)
		{
?>
														<a href="#" onclick="addFav(<?php echo $rowFavMenu[0]; ?>, 2)" title="Click to remove from Favorites"><img src="images/star_color.png" height="20px" width="20px" border="0" align="left"></a>
														<a class="menuText" id="menuText" href="<?php echo $rowFavMenu[2]; ?>" title="<?php echo $rowFavMenu[3]; ?>" >
															<b><?php echo $rowFavMenu[1]; ?></b>
														</a> <br /><br />
<?php
		}
?>
													</span>
<?php
	}
	else
	{
?>
													<span>You do not have any Favorites menu. Please click on the <img src="images/star_none.png" height="20px" width="20px" border="0"> in front of the menu link to add them to your Favorites.</span>
<?php		
	}
?>
        		        						</div>
<?php
	for ($j=1; $j < count($menuCatID); $j++)
	{
?>
												<div align="left">
<?php
		$cntMenu = $menuClass->cntMenu($menuCatID[$j]);

		if ($cntMenu > 0)
		{
			$getMenu = $menuClass->getMenu($menuCatID[$j]);
?>
													<span class="showMenu">
<?php
			foreach($getMenu as $rowMenu)
			{
?>
														<a href="#" onclick="addFav(<?php echo $rowMenu[0]; ?>, 2)" title="Click to add to Favorites"><img src="images/star_none.png" height="20px" width="20px" border="0" align="left"></a>&nbsp;&nbsp;
														<a class="menuText" id="menuText" href="<?php echo $rowMenu[2]; ?>" title="<?php echo $rowMenu[3]; ?>">
															<b><?php echo $rowMenu[1]; ?></b>
														</a>
														<br /><br />
<?php
			}
?>
													</span>
<?php
		}
?>
												</div>
<?php
	}
?>						            			
            								</div>
								        </div>
								    </div>    
								</div>
							</div>
						</div>
<?php
	include_once('include/footer.php');
?>		