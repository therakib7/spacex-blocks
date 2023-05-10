const { useState, useEffect } = wp.element;
const { __ } = wp.i18n;
export default function (props) {
	let initForm = {
		name: '',
		status: '',
		country: '',
	};
	const [form, setForm] = useState(initForm);
	const [clear, setClear] = useState(false);

	const handleChange = (e) => {
		const { name, value } = e.target;
		setClear(true);
		setForm({ ...form, [name]: value });
	}

	const onSubmit = (e) => {
		props.onSubmit(form);
	}

	const clearForm = (e) => {
		setClear(false);
		setForm(initForm);
		props.onSubmit(null);
	}

	return (
		<div className="bfsb-search-form">
			<div className="bfsb-search-field">
				<input
					id="bfsb-field-namme"
					type="text"
					name="name"
					placeholder={__('Search by Name', 'spacex-blocks')}
					value={form.name}
					onChange={handleChange}
				/>
			</div>

			<div className="bfsb-search-field">
				<select id="bfsb-field-status" name="status" value={form.status} onChange={handleChange}>
					<option value="">{__('Select Status', 'spacex-blocks')}</option>
					<option value="1">{__('Active', 'spacex-blocks')}</option>
					<option value="0">{__('Inactive', 'spacex-blocks')}</option>
				</select>
			</div>

			<div className="bfsb-search-field">
				<select id="bfsb-field-country" name="country" value={form.country} onChange={handleChange}>
					<option value="">{__('Select Country', 'spacex-blocks')}</option>
					<option value="United States">United States</option>
					<option value="Republic of the Marshall Islands">Marshall Islands</option>
				</select>
			</div>

			<div className="bfsb-search-field">
				<button onClick={onSubmit}>{__('Search', 'spacex-blocks')}</button>
			</div>
			<div className="bfsb-search-field">
				{clear && <span className="bfsb-search-clean" onClick={clearForm}>
					<svg
						width={20}
						height={20}
						viewBox="0 0 16 16"
						fill="none"
					>
						<path
							d="M12.5 3.5L3.5 12.5"
							stroke="#718096"
							strokeLinecap="round"
							strokeLinejoin="round"
						/>
						<path
							d="M12.5 12.5L3.5 3.5"
							stroke="#718096"
							strokeLinecap="round"
							strokeLinejoin="round"
						/>
					</svg>
				</span>}
			</div>

		</div>
	);
} 