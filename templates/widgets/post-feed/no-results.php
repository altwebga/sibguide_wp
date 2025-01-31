<div class="ts-no-posts <?= ! empty( $results['ids'] ) ? 'hidden' : '' ?>">
	<?= \Voxel\get_icon_markup( $this->get_settings_for_display('ts_noresults_icon') ) ?: \Voxel\svg( 'keyword-research.svg' ) ?>
	<p><?= $this->get_settings_for_display('ts_noresults_text') ?></p>
	<a href="#" class="ts-btn ts-btn-1 ts-btn-large ts-feed-reset">
		<?= \Voxel\get_icon_markup( $this->get_settings_for_display('ts_reset_ico') ) ?: \Voxel\svg( 'reload.svg' ) ?>
		<?= _x( 'Reset', 'post feed', 'voxel' ) ?>
	</a>
</div>
