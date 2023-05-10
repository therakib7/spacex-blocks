const { useState, useEffect } = wp.element;
import apiFetch from '@wordpress/api-fetch';
const { __ } = wp.i18n;

const { apiUrl, nonce } = bfsb;

import Spinner from 'block/preloader/spinner';
import Search from './Search';
import Item from './Item';
import Details from './Details';

import './style.scss';

export default function (props) {

	const [data, setData] = useState({
		docs: [],
		page: 1,
		hasPrevPage: false,
		hasNextPage: false
	});
	const [preloader, setPreloader] = useState(true);
	const [searchArgsOld, setSearchArgsOld] = useState(null);
	const [detailsModal, setDetailsModal] = useState(false);
	const [details, setDetails] = useState(null);
	const { grid, perPage } = props;

	useEffect(() => {
		getList()
	}, []);

	const getList = (searchArgs = null, pagi = false, pagi_type) => {

		let args = {
			page: data.page,
			per_page: perPage
		}

		if (searchArgs) {
			setSearchArgsOld(searchArgs);
			setPreloader(true);
		} else { //search filter and pagination
			if (searchArgsOld) {
				searchArgs = searchArgsOld;
			}
		}

		if (pagi) {
			setPreloader(true);
			if (pagi_type == 'prev') {
				args.page = (data.page - 1);
			} else {
				args.page = (data.page + 1);
			}
		}

		if (searchArgs) {
			//Filter all falsy values ( "", 0, false, null, undefined )
			searchArgs = Object.entries(searchArgs).reduce((a, [k, v]) => (v ? (a[k] = v, a) : a), {})
			args = { ...args, ...searchArgs }
		}

		let params = new URLSearchParams(args).toString();

		apiFetch({
			path: `${apiUrl}bfsb/v1/spacex-data/?${params}`,
			headers: {
				"content-type": "application/json",
				"X-WP-NONCE": nonce,
			}
		})
			.then(resp => {
				setData(resp.data.result);
				setPreloader(false);
			})
			.catch(error => console.error(error));
	}

	return (
		<>
			<Search onSubmit={getList} />

			{preloader && <Spinner />}

			{!preloader && <>
				<div className="bfsb-list" style={{ gridTemplateColumns: ('1fr '.repeat(grid)) }}>
					{data.docs.map((item, i) => {
						return (<Item key={i} item={item} details={(data) => {
							setDetailsModal(true);
							setDetails(data);
						}} />);
					})}
				</div>

				{(data.hasPrevPage || data.hasNextPage) && <div className="bfsb-pagi">
					{data.hasPrevPage && <button onClick={() => getList(null, true, 'prev')} className="bfsb-pagi-prev">{__('Previous', 'spacex-blocks')}</button>}
					{data.hasNextPage && <button onClick={() => getList(null, true, 'next')} className="bfsb-pagi-next">{__('Next', 'spacex-blocks')}</button>}
				</div>}

				{detailsModal && <Details data={details} close={() => setDetailsModal(false)} />}
			</>}
		</>
	);
} 