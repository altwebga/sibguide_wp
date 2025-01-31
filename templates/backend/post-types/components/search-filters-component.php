<?php
/**
 * Search filters - component template.
 *
 * @since 1.0
 */
if ( ! defined('ABSPATH') ) {
	exit;
} ?>
<script type="text/html" id="post-type-search-filters-template">
	<div class="x-row">
		<div class="used-fields x-col-6">
			<div class="sub-heading">
				<p>Used filters</p>
			</div>
			<div class="field-container ts-draggable-inserts" ref="fields-container">
				<draggable v-model="$root.config.search.filters" group="filters" handle=".field-head" item-key="key" @start="dragStart" @end="dragEnd" @add="onAdd">
					<template #item="{element: filter}">
						<div :class="{open: isActive(filter)}" class="single-field wide">
							<div class="field-head" @click="toggleActive(filter)">
								<p class="field-name">{{ filter.label }}</p>
								<span class="field-type">{{ filter.type }}</span>
								<div class="field-actions">
									<span class="field-action all-center">
										<a href="#" @click.prevent="deleteFilter(filter)">
											<i class="lar la-trash-alt icon-sm"></i>
										</a>
									</span>
								</div>
							</div>
							<div v-if="isActive(filter)" class="field-body">
								<div class="x-row">
									<?= $filter_options_markup ?>
								</div>
							</div>
						</div>
					</template>
				</draggable>
			</div>
		</div>
		<div class="x-col-1"></div>
		<div class="x-col-5">
			<div class="available-fields-container">
				<div class="sub-heading">
					<p>Available filters</p>
				</div>
				<draggable class="add-field" :list="Object.values(filter_types)" :group="{ name: 'filters', pull: 'clone', put: false }" :sort="false" item-key="key">
					<template #item="{element: filter_type}">
						<div>
							<div v-if="canAddFilter(filter_type)" class="">
								<div @click.prevent="addFilter(filter_type)" class="ts-button ts-outline c-move">
									{{ filter_type.label }}
								</div>
							</div>
						</div>
					</template>
				</draggable>
			</div>
		</div>
	</div>
</script>
