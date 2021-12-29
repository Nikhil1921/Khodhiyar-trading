<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="col-sm-12">
	<div class="card">
		<div class="card-header">
			<h5><?= ucwords($operation . ' ' . $title) ?></h5>
		</div>
		<div class="card-block">
			<?= form_open($url . '/add') ?>
			<div class="row">
				<div class="col-12">
					<div class="form-group">
						<?php $prods[0] = 'Select product';
						foreach ($products as $v)
							$prods[e_id($v['id'])] = $v['prod_name'];
						?>
						<?= form_dropdown('prod_id', $prods, set_value('prod_id'), 'class="form-control form-control-round" id="prod_id"') ?>
						<?= form_error('prod_id') ?>
					</div>
				</div>
				<div class="col-12">
					<div class="form-group">
						<?php $vends[0] = 'Select vendor';
						foreach ($vendors as $v)
							$vends[e_id($v['id'])] = $v['name'];
						?>
						<?= form_dropdown('ven_id', $vends, set_value('ven_id'), 'class="form-control form-control-round" id="ven_id"') ?>
						<?= form_error('ven_id') ?>
					</div>
				</div>
				<div class="col-6">
					<div class="form-group">
						<?= form_input('price', set_value('price'), 'class="form-control form-control-round" id="price" placeholder="Product price"') ?>
						<?= form_error('price') ?>
					</div>
				</div>
				<div class="col-6">
					<div class="form-group">
						<?= form_input('qty', set_value('qty'), 'class="form-control form-control-round" id="qty" placeholder="Product Quantity"') ?>
						<?= form_error('qty') ?>
					</div>
				</div>
				<div class="col-12">
					<?= form_button([
					'content' => 'Save',
					'type'  => 'submit',
					'class' => 'btn btn-outline-info btn-round col-3'
					]) ?>
					<?= anchor($url, 'Cancel', ['class' => 'btn btn-outline-danger btn-round col-3']) ?>
				</div>
			</div>
			<?= form_close() ?>
		</div>
	</div>
</div>