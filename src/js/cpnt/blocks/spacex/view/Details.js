export default function (props) {
	const { data } = props;
	return (
		<div className="bfsb-modal-overlay">
			<div className="bfsb-modal">

				<div className="bfsb-modal-header">
					<span className="bfsb-close" onClick={() => props.close()}>
						<svg
							width={25}
							height={25}
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
					</span>
					<h2 className="bfsb-modal-title">{data.name}</h2>
				</div>

				<div className="bfsb-modal-content">
					<img src={data.flickr_images[0]} alt={data.name} />
					<p>{data.description}</p>

					<div className="bfsb-details">
						<div className="bfsb-column">
							<div className="bfsb-label">Height:</div>
							<div className="bfsb-value">{data.height.meters} m ({data.height.feet} ft)</div>
							<div className="bfsb-label">Diameter:</div>
							<div className="bfsb-value">{data.diameter.meters} m ({data.diameter.feet} ft)</div>
							<div className="bfsb-label">Mass:</div>
							<div className="bfsb-value">{data.mass.kg} kg ({data.mass.lb} lb)</div>
							<div className="bfsb-label">Payload Weights:</div>
							{data.payload_weights.map((payload, index) => (
								<div className="bfsb-value" key={index}>
									{payload.name}: {payload.kg} kg ({payload.lb} lb)
								</div>
							))}
						</div>

						<div className="bfsb-column">
							<div className="bfsb-label">First Stage:</div>
							<div className="bfsb-value">Engines: {data.first_stage.engines}</div>
							<div className="bfsb-value">
								Thrust (Sea Level): {data.first_stage.thrust_sea_level.kN} kN ({data.first_stage.thrust_sea_level.lbf} lbf)
							</div>
							<div className="bfsb-value">
								Thrust (Vacuum): {data.first_stage.thrust_vacuum.kN} kN ({data.first_stage.thrust_vacuum.lbf} lbf)
							</div>
							<div className="bfsb-value">Fuel Amount: {data.first_stage.fuel_amount_tons} tons</div>
							<div className="bfsb-value">Burn Time: {data.first_stage.burn_time_sec} sec</div>
							<div className="bfsb-value">Reusable: {data.first_stage.reusable ? "Yes" : "No"}</div>
						</div>


						<div className="bfsb-column">
							<div className="bfsb-label">Second Stage:</div>
							<div className="bfsb-value">Engines: {data.second_stage.engines}</div>
							<div className="bfsb-value">
								Thrust: {data.second_stage.thrust.kN} kN ({data.second_stage.thrust.lbf} lbf)
							</div>
							<div className="bfsb-value">Fuel Amount: {data.second_stage.fuel_amount_tons} tons</div>
							<div className="bfsb-value">Burn Time: {data.second_stage.burn_time_sec} sec</div>
							<div className="bfsb-value">Reusable: {data.second_stage.reusable ? "Yes" : "No"}</div>
							<div className="bfsb-value">
								Payloads:
								{Object.entries(data.second_stage.payloads).map(([key, value]) => (
									<div key={key}>
										{key}: {typeof value === "object" ? `${value.meters} m (${value.feet} ft)` : value}
									</div>
								))}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	);
} 