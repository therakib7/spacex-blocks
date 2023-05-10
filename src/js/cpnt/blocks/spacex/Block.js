
const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;

import Edit from './Edit';

registerBlockType('bfsb/spacex-data', {
	title: __('SpaceX Data', 'spacex-blocks'),
	icon: 'grid-view',
	category: 'common',
	description: __('Show SpaceX Rockets or Capsules on your site', 'spacex-blocks'),
	keywords: ['SpaceX', 'Rockets', 'Capsules'],
	/**
	 * @see ./Edit.js
	 */
	edit: Edit,

	/**
	 * @see ./Save.js
	 */
	// save,
	save: () => null
});
