
const { createRoot } = wp.element;
import View from 'cpnt/blocks/spacex/view';

document.addEventListener('DOMContentLoaded', function () {
	let el = document.getElementById('bfsb-spacex-data');
	if (typeof el !== 'undefined' && el !== null) {
		const root = createRoot(el);
		let grid = el.getAttribute('data-grid');
		let perPage = el.getAttribute('data-per-page');
		root.render(<View grid={grid} perPage={perPage} />);
	}
});
