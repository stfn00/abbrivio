/**
 * ==========================================================================
 * Do's and don'ts block
 * ==========================================================================
 */



/**
 * Internal dependencies
 */
import Edit from './edit';

/**
 * WordPress Dependencies
 */
import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { InnerBlocks } from '@wordpress/block-editor';

/**
 * Register block type
 */
registerBlockType( 'abbrivio-blocks/dos-and-donts', {
	/**
	 * Block title
	 *
	 * @type {string}
	 */
	title: __( "Dos and dont's", 'abbrivio' ),

	/**
	 * Block icon
	 *
	 * @type {string}
	 */
	icon: 'editor-table',

	/**
	 * Block description
	 *
	 * @type {string}
	 */
	description: __( 'Add headings and text', 'abbrivio' ),

	/**
	 * Block category
	 *
	 * @type {string}
	 */
	category: 'abbrivio',

	edit: Edit,

	/**
	 * Save
	 *
	 * @return {Object} Save content
	 */
	save() {
		return (
			<div className="abbrivio-dos-and-donts">
				<InnerBlocks.Content />
			</div>
		);
	},
} );
