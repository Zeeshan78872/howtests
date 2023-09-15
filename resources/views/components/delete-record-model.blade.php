<button type="button" class="btn btn-danger btn-sm mt-2" data-bs-toggle="modal"
    data-bs-target="#{{ 'ModelDelete' . $model_id }}">
    <i class="fas fa-trash"></i>
</button>
<!-- Modal (Question with Answer) -->
<div class="modal fade" id="{{ 'ModelDelete' . $model_id }}" tabindex="-1" data-bs-backdrop="static"
    data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
        <div class="modal-content" id="downloadModal">
            <div class="text-right py-2  px-3 w-100">
                <button type="button" class="closebtn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row text-center">
                    <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                        <div class="mb-3 text-center ">
                            <i style="font-size: 100px;" class="fa-regular fa-circle-xmark text-danger"></i>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                        <div class="mb-3">
                            <div class="text-center p-4">
                                <h5 class="modal-title" id="modalTitleId">Are you sure you want to delete ?
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                        <div class="mb-3">
                            <div class="text-center p-4">
                                {{-- <form action="{{ $action }}" method="POST">
                                      @method('DELETE') --}}
                                <a href="{{ $action }}" class="btn btn-danger">Delete</a>
                                {{-- </form> --}}
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </div>
    </div>
</div>
