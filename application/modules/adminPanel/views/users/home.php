<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-sm-12">
	<div class="card">
		<div class="card-header">
			<h5>List of <?= ucwords($title) ?></h5>
            <?= anchor("$url/add", 'Add', ['class' => 'btn btn-outline-primary btn-round col-2 float-right']) ?>
		</div>
		<div class="card-block">
			<div class="dt-responsive table-responsive">
				<table class="datatable table table-striped table-bordered nowrap">
					<thead>
						<tr>
							<th class="target">Sr.</th>
							<th>Name</th>
							<th>Mobile</th>
							<th>Email</th>
							<th class="target">Action</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>