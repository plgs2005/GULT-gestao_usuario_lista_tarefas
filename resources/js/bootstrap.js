window._ = require('lodash');
import {NAME_TOKEN} from './config/config'

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
   

    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');
/* 
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if(token){
    window.axios.defaults.headers.common['XCSRF-TOKEN']= token.content;

}else{
    console.error('CSRF TOKEN NOT FOUND')
}
 */
const tokenAccess = localStorage.getItem(NAME_TOKEN)
if(tokenAccess)
window.axios.defaults.headers.common['Authorization']= `Bearer ${tokenAccess}`;