import { createRoot } from '@wordpress/element';
import Welcome from 'cpnt/welcome';

document.addEventListener('DOMContentLoaded', function () {
    let el = document.getElementById('bfsb-welcome');
    if (typeof el !== 'undefined' && el !== null) {
        const root = createRoot(el);
        root.render(
            <React.StrictMode>
                <Welcome />
            </React.StrictMode>
        );
    }
});
