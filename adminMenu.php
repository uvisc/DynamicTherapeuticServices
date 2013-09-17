<?php 
	//session_start();
	$pageTitle = "Admin Menu";	

	$cntMenuCategories = $menuClass->cntMenuCategory();

?>
					<div class="span12">
						<div class="row-fluid">
							<div class="span3 text-left">
								<form name="formMenu" method="post" onSubmit="return goTo()">
									<font color="#CC0000"><strong>SELECT MENU FROM DROP DOWN</strong></font>
									<select name="Menu" onChange="goTo()">
										<option value="0">-- Select Menu --</option>
										<option style="color:blue;font-weight: bold;" value="admin.php">Admin Home</option>
<?php
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
								        <option style="color:red;" value="admin.php"><?php echo $menuCat[1]; ?></option>
<?php
				if (strtolower($menuCat[1]) == "favorites")
				{
					$cntFavMenu = $menuClass->cntFavMenu();

					if ($cntFavMenu > 0)
					{
						$getFavMenu = $menuClass->getFavMenu();

						foreach($getFavMenu as $rowFavMenu)
						{
?>
										<option value="<?php echo $rowFavMenu[2]; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $rowFavMenu[1]; ?></option>
<?php
						}
					}
				}
				else
				{
					$cntMenu = $menuClass->cntMenu($menuCat[0]);

					if ($cntMenu > 0)
					{
						$getMenu = $menuClass->getMenu($menuCat[0]);
						
						foreach($getMenu as $rowMenu)
						{		
?>
										<option value="<?php echo $rowMenu[2]; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $rowMenu[1]; ?></option>
<?php
						}
					}
				}
			}
		}
	}
?>
									</select>				
								</form>			
							</div>
							<div class="span1 text-center">
								<a href="admin.php">
									<img src="images/house.jpg" border="0" width="30" height="30" alt="Home" id="Home">
								</a>		
							</div>
							<div class="span4">&nbsp;</div>
							<div class="span4" align="right">								
<?php
	if ($_SESSION['UserPic'] != "")
	{
		list($width, $height) = getimagesize($_SESSION['UserPic']);
		if ($width == $height)
		{
			$newWidth = "25";
			$newHeight = "25";
		}
		else
		{
			$newWidth = ($width * 25)/$height;
			$newHeight = "25";
		}
		$pic = "<img src=\"" . $_SESSION['UserPic'] . "\" border=\"0\" width=\"" . $newWidth . "px height=\"" . $newHeight . "px\" />";
	}
	else
	{
		$pic = "";
	}
?>
								<ul class="nav nav-pills">  
								    <li class="dropdown all-camera-dropdown">  
								    	<a class="dropdown-toggle" data-toggle="dropdown" href="#">  
								    		Help & Support  
								    		<b class="caret"></b>  
								    	</a>  
								    	<ul class="dropdown-menu">  
								    		<li data-filter-camera-type="all"><a data-toggle="tab" href="#" onclick="redirectPage('videoTutorial.php')">Video Tutorials</a></li>  
								    		<li data-filter-camera-type="Alpha"><a data-toggle="tab" href="#" onclick="redirectPage('faq.php')">FAQs</a></li>  
<?php
	if (($_SESSION['GroupID'] != "1") && ($_SESSION['GroupID'] != "2"))
	{
?>
											<li data-filter-camera-type="Zed"><a data-toggle="tab" href="#" onclick="redirectPage('contactAdmin.php')">Contact Us</a></li> 										
<?php
	}
?>									    		
								    	</ul>  
								    </li>
								    <li class="dropdown all-camera-dropdown">  
								    	<a class="dropdown-toggle" data-toggle="dropdown" href="#">  
								    		<?php echo $_SESSION['UserFullName']; ?>  
								    		<b class="caret"></b>  
								    	</a>  
								    	<ul class="dropdown-menu">  
								    		<li data-filter-camera-type="all"><a data-toggle="tab" href="#" onclick="redirectPage('admin.php?groupID=<?php echo $_SESSION['GroupID']; ?>')"><?php echo $pic . "&nbsp;&nbsp;" . $_SESSION['UserFullName'] . " - " . $_SESSION['GroupName']; ?></a></li>  
								    		<li data-filter-camera-type="Alpha"><a data-toggle="tab" href="#" onclick="redirectPage('logout.php')"><img src="images/lock.gif" width="7" height="9" border="0">&nbsp;&nbsp;Log Out</a></li>  
								    	</ul>  
								    </li>
								</ul>  
							</div>
						</div>
					</div>