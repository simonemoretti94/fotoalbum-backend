import './bootstrap';
import '~resources/scss/app.scss';
import '~icons/bootstrap-icons.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])

document.getElementById('p-show').addEventListener('click', function (e) {
    console.log(e.target);
    document.getElementById('div-js-show').classList.remove('d-none');
});