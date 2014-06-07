<?php
require_once(SYSTEM_URL.'classes/Menu.php');
$obj = new Menu();
$menu = $obj->get_menu_array($userType);
 ?>
<div class="fixed-menu" id="cl-wrapper">
		<div class="cl-sidebar">
			<div class="cl-toggle"><i class="fa fa-bars"></i></div>
			<div class="cl-navblock">
				<div class="menu-space">
					<div class="content">
						<ul class="cl-vnavigation">
						<?php foreach ($menu as $mk => $mv): ?>
							<li>
								<a href="#"><i class="fa <?php echo $mv['icon']; ?>"></i><span><?php print $mk; ?></span></a>
								<ul class="sub-menu">
								<?php
									foreach ($mv['items'] as $item): 
										$active = false;
										if ($obj->isActive($item['url']))
										{
											$active = true;
											$currentPage = $item['nombre'];
										}
								?>
									<li class="<?php print $active ? 'active' : ''; ?>"><a href="<?php echo $item['url']; ?>"><?php print $item['nombre']; ?></a></li>
								<?php endforeach; ?>
								</ul>
							</li>
						<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>