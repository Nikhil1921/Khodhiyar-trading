            <div class="row">
				<div class="col-6">
					<div class="form-group">
						<?= form_input('name', set_value('name') ? set_value('name') : (isset($data['name']) ? $data['name'] : ''), 'class="form-control form-control-round" id="name" placeholder="Name"') ?>
						<?= form_error('name') ?>
					</div>
				</div>
				<div class="col-6">
					<div class="form-group">
						<?= form_input('mobile', set_value('mobile') ? set_value('mobile') : (isset($data['mobile']) ? $data['mobile'] : ''), 'class="form-control form-control-round" id="mobile" maxlength="10" placeholder="Mobile"') ?>
						<?= form_error('mobile') ?>
					</div>
				</div>
				<div class="col-6">
					<div class="form-group">
						<?= form_input('email', set_value('email') ? set_value('email') : (isset($data['email']) ? $data['email'] : ''), 'class="form-control form-control-round" id="email" placeholder="Email"') ?>
						<?= form_error('email') ?>
					</div>
				</div>
				<div class="col-6">
					<div class="form-group">
                        <?= form_input([
							'type' => 'password',
							'name' => 'password',
							'class' => "form-control form-control-round",
							'placeholder' => "Password",
							'id' => "password",
							'maxLength' => "255"
						]) ?>
						<?= form_error('password') ?>
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