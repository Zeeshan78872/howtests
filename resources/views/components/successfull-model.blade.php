  <!-- Modal (Question with Answer) -->
  <div class="modal fade" id="successfulModel" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
      role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
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
                              <i style="font-size: 100px;" class="fa-regular fa-circle-check text-primary"></i>
                          </div>
                      </div>
                      <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                          <div class="mb-3">
                              <div class="text-center p-4">
                                  <h5 class="" id="modalTitleId">{{ $title }} successfull created
                                  </h5>
                              </div>
                          </div>
                      </div>


                  </div>
              </div>

          </div>
      </div>
  </div>
  @if (Session::has('success'))
      <script>
          document.addEventListener("DOMContentLoaded", function() {
              var myModal = new bootstrap.Modal(document.getElementById('successfulModel'));
              myModal.show();
          });
      </script>
  @endif
