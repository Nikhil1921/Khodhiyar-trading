<?php defined('BASEPATH') or exit('No direct script access allowed');
$pers = ['View' => 'View', 'Add' => 'Add', 'Update' => 'Update', 'Delete' => 'Delete'] ?>
<div class="col-sm-12">
	<div class="card">
		<div class="card-header">
			<h5><?= ucwords($operation . ' ' . $title) ?></h5>
		</div>
		<div class="card-block">
			<?= form_open($url) ?>
			<div class="row">
				<div class="col-12">
					<div class="form-group">
						<?= form_label('Rate(s)', 'rate') ?>
						<?= form_dropdown('permissions[rates][]', $pers, $rates, 'class="form-control js-example-basic-multiple" id="rate" multiple="multiple"') ?>
					</div>
				</div>
				<div class="col-12">
					<div class="form-group">
						<?= form_label('Item(s)', 'item') ?>
						<?= form_dropdown('permissions[items][]', $pers, $items, 'class="form-control js-example-basic-multiple" id="item" multiple="multiple"') ?>
					</div>
				</div>
				<div class="col-12">
					<div class="form-group">
						<?= form_label('Supplier(s)', 'supplier') ?>
						<?= form_dropdown('permissions[suppliers][]', $pers, $suppliers, 'class="form-control js-example-basic-multiple" id="supplier" multiple="multiple"') ?>
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