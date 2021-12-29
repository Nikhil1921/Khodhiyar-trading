<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-sm-12">
	<div class="card">
		<div class="card-header">
			<div class="row">
				<div class="col-md-4">
					<h5>List of <?= ucwords($title) ?></h5>
				</div>
				<div class="col-md-3">
					<input type="date" class="form-control" name="start-date" />
				</div>
				<div class="col-md-3">
					<input type="date" class="form-control" name="end-date" />
				</div>
				<div class="col-md-2">
					<button class="btn btn-outline-primary col-md-12 reload-data">Search</button>
				</div>
			</div>
		</div>
		<div class="card-block">
			<div class="dt-responsive table-responsive">
				<table class="datatable table table-striped table-bordered nowrap">
					<thead>
						<tr>
							<th class="target">Sr.</th>
							<th>Item</th>
							<th>Rate</th>
							<th>Quantity</th>
							<th>Note</th>
							<th>Date</th>
							<th>Supplier</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
					<tfoot>
						<tr>
							<th></th>
							<th></th>
							<th style="text-align:right">Total :</th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>
<input type="hidden" name="rate-total" />