const { InspectorControls } = wp.editor;
const { PanelBody, RangeControl, SelectControl } = wp.components;
const { __ } = wp.i18n;

import View from './view';

export default function (props) {

	const { attributes, setAttributes } = props;
	const { grid, perPage } = attributes;

	return (
		<>
			<View key={perPage} grid={grid} perPage={perPage} />

			<InspectorControls>
				<PanelBody title={__('Layout Settings', 'spacex-blocks')}>
					<SelectControl
						label={__('Grid Column', 'spacex-blocks')}
						value={grid}
						options={[
							{ value: 1, label: __('1 Column', 'spacex-blocks') },
							{ value: 2, label: __('2 Columns', 'spacex-blocks') },
							{ value: 3, label: __('3 Columns', 'spacex-blocks') },
							{ value: 4, label: __('4 Columns', 'spacex-blocks') },
						]}
						onChange={(value) => setAttributes({ grid: value })}
					/>
					<RangeControl
						label={__('Posts per Page', 'spacex-blocks')}
						value={perPage}
						onChange={(value) => setAttributes({ perPage: value })}
						min={1}
						max={30}
					/>
				</PanelBody>
			</InspectorControls>
		</>
	);
}