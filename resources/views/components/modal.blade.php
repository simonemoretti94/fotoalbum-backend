<p
    type="button"
    class="btn btn-link"
    data-bs-toggle="modal"
    data-bs-target="#modalId"
>
    {{$photo->id}}. {{$photo->title}}
</p>
<div
class="modal fade"
id="modalId"
tabindex="-1"
data-bs-backdrop="static"
data-bs-keyboard="false"

role="dialog"
aria-labelledby="modalTitleId"
aria-hidden="true"
>
<div
    class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
    role="document"
>
    <div class="modal-content">
        <div class="modal-header d-flex">
            <h5 class="col-10 text-center">Project {{$photo->id}} delete</h5>
            <button
                type="button"
                class="btn-close col-2"
                data-bs-dismiss="modal"
                aria-label="Close"
            ></button>
        </div>
        <div class="modal-body">Are you committed to delete this photo? Ater done, it won't be reversable</div>
        <div class="modal-footer d-flex flex-column">
            <button
                type="button"
                class="btn btn-secondary col-12"
                data-bs-dismiss="modal"
            >
                Close
            </button>
            <form action="{{route('admin.photos.destroy', $photo)}}"  method="post" class="col-12">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger bg-gradient col-12" >Delete</button>
            </form>
        </div>
    </div>
</div>
</div>