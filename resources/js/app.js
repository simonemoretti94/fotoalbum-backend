import './bootstrap';
import '~resources/scss/app.scss';
import '~icons/bootstrap-icons.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])

/* show head section */
let showHead = true;

document.getElementById('p-show-head').addEventListener('click', function (e) {
    console.log(e.target);
    if (showHead) {
        document.getElementById('div-js-show-head').classList.remove('d-none');
        showHead = !showHead;
    }
    else {
        document.getElementById('div-js-show-head').classList.add('d-none');
        showHead = !showHead;
    }
});

/* show section */
let show = true;

document.getElementById('p-show').addEventListener('click', function (e) {
    console.log(e.target);
    if (show) {
        document.getElementById('div-js-show').classList.remove('d-none');
        show = !show;
    }
    else {
        document.getElementById('div-js-show').classList.add('d-none');
        show = !show;
    }
});

/* edit head section */
let editHead = true;

document.getElementById('p-edit-head').addEventListener('click', function (e) {
    console.log(e.target);
    if (editHead) {
        document.getElementById('div-js-edit-head').classList.remove('d-none');
        editHead = !editHead;
    }
    else {
        document.getElementById('div-js-edit-head').classList.add('d-none');
        editHead = !editHead;
    }
});

/* edit section */
let edit = true;

document.getElementById('p-edit').addEventListener('click', function (e) {
    console.log(e.target);
    if (edit) {
        document.getElementById('div-js-edit').classList.remove('d-none');
        edit = !edit;
    }
    else {
        document.getElementById('div-js-edit').classList.add('d-none');
        edit = !edit;
    }
});