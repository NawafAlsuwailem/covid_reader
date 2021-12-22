import landing from "./pages/landing";
import countryList from "./pages/countryList";
import addCountry from "./pages/addCountry";

export const routes = [
    {
        name: 'landing',
        path: '/',
        component: landing
    },
    {
        name: 'countryList',
        path: '/list',
        component: countryList
    },
    {
        name: 'addCountry',
        path: '/addCountry',
        component: addCountry
    },
    // {
    //     name: 'edit',
    //     path: '/edit/:id',
    //     component: EditBook
    // }
];
