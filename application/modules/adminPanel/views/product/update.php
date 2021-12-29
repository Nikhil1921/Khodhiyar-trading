<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="col-sm-12">
	<div class="card">
		<div class="card-header">
			<h5><?= ucwords($operation . ' ' . $title) ?></h5>
		</div>
		<div class="card-block">
			<?= form_open($url."/update/$id") ?>
			<div class="row">
				<div class="col-12">
					<div class="form-group">
						<?php $cats[0] = 'Select Category';
						foreach ($category as $v)
							$cats[e_id($v['id'])] = $v['category'];
						?>
						<?= form_dropdown('cat_id', $cats, (set_value('cat_id')) ? set_value('cat_id') : e_id($data['cat_id']), 'class="form-control form-control-round" id="cat_id"') ?>
						<?= form_error('cat_id') ?>
					</div>
				</div>
				<div class="col-12">
					<div class="form-group">
						<?= form_input('prod_name', (set_value('prod_name')) ? set_value('prod_name') : $data['prod_name'], 'class="form-control form-control-round" id="prod_name" placeholder="Product name"') ?>
						<?= form_error('prod_name') ?>
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