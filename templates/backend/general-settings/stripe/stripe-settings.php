<?php
if ( ! defined('ABSPATH') ) {
	exit;
} ?>
<ul class="inner-tabs">
	<li :class="{'current-item': tab === 'cloudpayments' && subtab === 'general'}">
		<a href="#" @click.prevent="setTab('cloudpayments', 'general')">General</a>
	</li>
	<li :class="{'current-item': tab === 'cloudpayments' && subtab === 'webhooks'}">
		<a href="#" @click.prevent="setTab('cloudpayments', 'webhooks')">Webhooks</a>
	</li>
	<li :class="{'current-item': tab === 'cloudpayments' && subtab === 'portal'}">
		<a href="#" @click.prevent="setTab('cloudpayments', 'portal')">Customer portal</a>
	</li>
</ul>

<template v-if="subtab === 'portal'">
	<?php require_once locate_template( 'templates/backend/general-settings/cloudpayments/customer-portal-settings.php' ) ?>
</template>
<template v-else-if="subtab === 'webhooks'">
	<?php require_once locate_template( 'templates/backend/general-settings/cloudpayments/webhook-settings.php' ) ?>
</template>
<template v-else-if="subtab === 'general'">
	<div class="ts-group">
		<div class="ts-group-head"><h3>General</h3></div>
		<div class="x-row">
			<?php \Voxel\Form_Models\Select_Model::render( [
				'v-model' => 'config.cloudpayments.currency',
				'label' => 'Currency',
				'choices' => \Voxel\CloudPayments\Currencies::all(),
				'classes' => 'x-col-12',
			] ) ?>
		</div>
	</div>
	<div class="ts-group">
		<div class="ts-group-head">
			<h3>Live mode API keys</h3>
		</div>
		<div class="x-row">
			<div class="ts-form-group x-col-12">
				<p>
					Enter your CloudPayments account API keys. You can get your keys in
					<a href="https://dashboard.cloudpayments.com/apikeys" target="_blank">dashboard.cloudpayments.com/apikeys</a>
				</p>
			</div>
			<?php \Voxel\Form_Models\Text_Model::render( [
				'v-model' => 'config.cloudpayments.key',
				'label' => 'Public key',
				'classes' => 'x-col-6',
			] ) ?>

			<?php \Voxel\Form_Models\Password_Model::render( [
				'v-model' => 'config.cloudpayments.secret',
				'label' => 'Secret key',
				'classes' => 'x-col-6',
				'autocomplete' => 'new-password',
			] ) ?>
		</div>
	</div>
	<div class="ts-group">
		<div class="ts-group-head">
			<h3>Test mode API keys</h3>
		</div>
		<div class="x-row">

			<?php \Voxel\Form_Models\Switcher_Model::render( [
				'v-model' => 'config.cloudpayments.test_mode',
				'label' => 'Enable CloudPayments test mode',
				'classes' => 'x-col-12',
			] ) ?>

			<template v-if="config.cloudpayments.test_mode">
				<?php \Voxel\Form_Models\Text_Model::render( [
					'v-model' => 'config.cloudpayments.test_key',
					'label' => 'Test public key',
					'classes' => 'x-col-6',
				] ) ?>

				<?php \Voxel\Form_Models\Password_Model::render( [
					'v-model' => 'config.cloudpayments.test_secret',
					'label' => 'Test secret key',
					'classes' => 'x-col-6',
					'autocomplete' => 'new-password',
				] ) ?>
			</template>
		</div>
	</div>
	<div class="ts-group">
		<div class="ts-group-head">
			<h3>Local CloudPayments</h3>
		</div>
		<div class="x-row">
			<?php \Voxel\Form_Models\Switcher_Model::render( [
				'v-model' => 'config.cloudpayments.webhooks.local.enabled',
				'label' => 'This is a local installation',
				'classes' => 'x-col-12',
			] ) ?>


			<div v-if="config.cloudpayments.webhooks.local.enabled" class="ts-form-group x-col-12">
				<label>Follow these steps to setup CloudPayments webhook events on a local installation:</label>
				<p>Read more about local testing <a href="https://cloudpayments.com/docs/webhooks/test" target="_blank">here.</a></p>
				<ol>
					<li>
						<a href="https://cloudpayments.com/docs/cloudpayments-cli" target="_blank">Install the CloudPayments CLI</a>
						and log in to authenticate your account.
					</li>
					<li>
						Forward webhook events to your local endpoint using the following command:<br>
						<pre class="ts-snippet"><span class="ts-green">cloudpayments</span> listen <span class="ts-italic">--forward-to="<?= home_url('?vx=1&action=cloudpayments.webhooks') ?>"</span></pre>
					</li>
					<li>
						Paste the generated webhook signing secret below.
					</li>
				</ol>
			</div>

			<div v-if="config.cloudpayments.webhooks.local.enabled" class="ts-form-group x-col-12">
				<label>Webhook secret from CloudPayments CLI</label>
				<input type="text" v-model="config.cloudpayments.webhooks.local.secret">

			</div>
		</div>
	</div>
</template>

