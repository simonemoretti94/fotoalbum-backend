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

document.getElementById('p-show-head').addEventListener('click', function (e) {
    console.log(e.target);
    document.getElementById('div-js-show-head').classList.remove('d-none');
});

document.getElementById('p-edit').addEventListener('click', function (e) {
    console.log(e.target);
    document.getElementById('div-js-edit').classList.remove('d-none');
});

document.getElementById('p-edit-head').addEventListener('click', function (e) {
    console.log(e.target);
    document.getElementById('div-js-edit-head').classList.remove('d-none');
});