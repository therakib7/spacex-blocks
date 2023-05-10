const { __ } = wp.i18n;
export default function (props) {

	const { item } = props;

	return (
		<div className="bfsb-item" onClick={() => props.details(item)}>
			<img className="bfsb-item-img" src={item.flickr_images[0]} alt={item.name} />
			<h4 className="bfsb-item-name">{item.name}</h4>
			<p className="bfsb-item-desc">{item.description}</p>
			<button className="bfsb-item-details">{__('Check Details', 'spacex-blocks')}</button>
		</div>
	);
} 