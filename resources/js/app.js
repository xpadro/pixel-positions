import './bootstrap';

// Load images folder so they are available in the view (Otherwsie they will in dev mode but not when building app)
import.meta.glob([
    '../images/**'
]);