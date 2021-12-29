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
						<?= form_input('name', set_value('name'), 'class="form-control form-control-round" id="name" placeholder="Name"') ?>
						<?= form_error('name') ?>
					</div>
				</div>
				<div class="col-12">
					<div class="form-group">
						<?= form_input('mobile', set_value('mobile'), 'class="form-control form-control-round" id="mobile" placeholder="Mobile" maxlength="10"') ?>
						<?= form_error('mobile') ?>
					</div>
				</div>
				<div class="col-12">
					<div class="form-group">
						<?= form_input([
						'type'  => 'email',
						'name'  => 'email',
						'id'    => 'email',
						'value' => set_value('email'),
						'class' => 'form-control form-control-round',
						'maxlength' => 255,
						'placeholder' => 'Email'
						]) ?>
						<?= form_error('email') ?>
					</div>
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
			<?= form_close() ?>
		</div>
	</div>
</div>