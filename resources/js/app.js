import $ from 'jquery';
import Popper from 'popper.js';
import PerfectScrollbar from 'perfect-scrollbar';

window.Popper = Popper;
window.jQuery = $;
window.$ = $;

window.$.fn.perfectScrollbar = function (options) {

    return this.each((k, elm) => new PerfectScrollbar(elm, options || {}));
};

require('./bootstrap');
