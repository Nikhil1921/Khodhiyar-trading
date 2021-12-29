<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-xl-3" onclick="window.location = '<?= base_url(admin('product')) ?>'">
	<div class="card bg-c-green text-white">
		<div class="card-block">
			<div class="row align-items-center">
				<div class="col">
					<p class="m-b-5">Item(s)</p>
					<h4 class="m-b-0"><?= $product ?></h4>
				</div>
				<div class="col col-auto text-right">
					<i
					class="feather icon-credit-card f-50 text-c-green"></i>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="col-xl-3" onclick="window.location = '<?= base_url(admin('vendor')) ?>'">
	<div class="card bg-c-pink text-white">
		<div class="card-block">
			<div class="row align-items-center">
				<div class="col">
					<p class="m-b-5">Supplier(s)</p>
					<h4 class="m-b-0"><?= $vendor ?></h4>
				</div>
				<div class="col col-auto text-right">
					<i class="feather icon-users f-50 text-c-pink"></i>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="col-xl-3" onclick="window.location = '<?= base_url(admin('inventory')) ?>'">
	<div class="card bg-c-blue text-white">
		<div class="card-block">
			<div class="row align-items-center">
				<div class="col">
					<p class="m-b-5">Rate(s)</p>
					<h4 class="m-b-0"><?= $inventory ?></h4>
				</div>
				<div class="col col-auto text-right">
					<i
					class="feather icon-shopping-cart f-50 text-c-blue"></i>
				</div>
			</div>
		</div>
	</div>
</div>