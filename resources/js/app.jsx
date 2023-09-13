import './bootstrap';
import "../css/app.css";
import React from "react";
import {createRoot} from 'react-dom/client'
import { createInertiaApp } from "@inertiajs/inertia-react";
import { InertiaProgress } from "@inertiajs/progress";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";

    createInertiaApp({
        // Below you can see that we are going to get all React components from resources/js/Pages folder
        resolve: (name) => resolvePageComponent(`./Pages/${name}.jsx`,import.meta.glob('./Pages/**/*.jsx')),
        setup({ el, App, props }) {
            createRoot(el).render(<App {...props} />)
        },
    })

// you can specify any color of choice
InertiaProgress.init({ color: "#4B5563" });