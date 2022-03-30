<ul class="sidebar-nav pb-5">
	<?php foreach($secmenu as $modul){ switch ($modul['menugroup']) { case "Module" :  ?>

		<li class="sidebar-header">
			<?= $modul['menuname'];?>
		</li>

		<?php foreach($secmenu as $parent){ switch ($parent['menugroup']) { case "Parent" :  ?>

			<?php if ($modul['menuid'] == $parent['parentid']) { ?>

				<?php if ($parent['action'] != "-") { ?>

					<li class="sidebar-item <?php if ($parent['menukey'] == $menukey) { echo "active"; }?>">
						<a class="sidebar-link" href="<?= site_url($parent['controller'].'/'.$parent['action']) ?>">
							<i class="align-middle me-2 fas fa-fw <?= $parent['iconclass'];?>"></i> <span class="align-middle"><?= $parent['menuname'];?></span>
						</a>
					</li>

				<?php }
				else { ?>

					<li class="sidebar-item <?php if ($parent['menukey'] == $menukey) { echo "active"; }?>">
						<a data-bs-target=#<?= $parent['menuname'];?> data-bs-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle me-2 fas fa-fw <?= $parent['iconclass'];?>"></i> <span class="align-middle"><?= $parent['menuname'];?></span>
						</a>

						<ul id="<?= $parent['menuname'];?>" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">

							<?php foreach($secmenu as $child){ switch ($child['menugroup']) { case "Child" :  ?>
								<?php if ($parent['menuid'] == $child['parentid']) { ?>
									<?php if ($child['action'] != "uc") { ?>
										<li class="sidebar-item <?php if ($child['menukey'] == $menukey) { echo "active"; }?>">
											<a class="sidebar-link" href="<?= site_url($child['controller'].'/'.$child['action']) ?>"><?= $child['menuname'];?></a>
										</li>
									<?php } ?>
								<?php } ?>
							<?php break; } } ?>

						</ul>

					</li>

				<?php } ?>

			<?php } ?>

		<?php break; } } ?>

	<?php break; } } ?>
</ul>