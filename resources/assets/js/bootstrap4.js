window._ = require('lodash');

import * as $ from 'jquery';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import bootstrapPlugin from '@fullcalendar/bootstrap'

window.Calendar = Calendar;
window.dayGridPlugin = dayGridPlugin;
window.bootstrapPlugin = bootstrapPlugin;
try {


    window.Popper = require('popper.js').default;
    window.jQuery =  require('jquery');
    window.$ = require('jquery');
    require('bootstrap');


    require( 'datatables.net-bs4' )($);



} catch (e) {
    console.log(e);
}
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
