import { useState, useEffect } from "react";

function useFetch(url, version = 0) {
	const [data, setData] = useState([]);
	const [loading, setLoading] = useState(true);

	async function fetchUrl() {
		const response = await fetch(url);
		const json = await response.json();

		setData(json);
		setLoading(false);
	}

	useEffect(() => {
		fetchUrl();
	}, [url, version]);
	return [data, loading];
}
export { useFetch };