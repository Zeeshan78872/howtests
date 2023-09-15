  <!-- Modal (Question with Answer) -->
  <div class="modal fade" id="{{ $ModelID }}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
      role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
          <div class="modal-content">
              <div class="text-end py-2">
                  <button type="button" class="modalCloseBtn" data-bs-dismiss="modal" aria-label="Close">
                      <i class="bi bi-x"></i>
                  </button>
              </div>
              <div class="text-center">
                  <h5 class="modal-title" id="modalTitleId">Enter Details To Download Book</h5>
              </div>
              <form id="clientForm" action="{{ route('AddClientMock', $id) }}" method="POST">
                  @csrf
                  <input type="hidden" name="downloadBy" value="{{ $DownloadBy }}">
                  <div class="modal-body">
                      <div class="row">
                          <div class="col-md-12">
                              <div class="mb-3 w-75 mx-auto">
                                  <label for="" class="form-label">Name <sup
                                          class="text-danger"><b>*</b></sup></label>
                                  <input type="text" class="form-control-custom" required name="name"
                                      id="" aria-describedby="helpId" placeholder="">
                              </div>
                          </div>
                          <div class="col-md-12">
                              <div class="mb-3 w-75 mx-auto">
                                  <label for="" class="form-label">Email <sup
                                          class="text-danger"><b>*</b></sup></label>
                                  <input type="email" class="form-control-custom" required name="email"
                                      id="" aria-describedby="helpId" placeholder="">
                              </div>
                          </div>
                          <div class="col-md-12">
                              <div class="mb-3 w-75 mx-auto">
                                  <label for="" class="form-label">City <sup
                                          class="text-danger"><b>*</b></sup></label>
                                  <input type="text" class="form-control-custom" required name="city"
                                      id="" aria-describedby="helpId" placeholder="">
                              </div>
                          </div>
                          <div class="col-md-12">
                              <div class="mb-3 w-75 mx-auto">
                                  <label for="" class="form-label">Province <sup
                                          class="text-danger"><b>*</b></sup></label>
                                  <input type="text" class="form-control-custom" required name="province"
                                      id="" aria-describedby="helpId" placeholder="">
                              </div>
                          </div>
                          <div class="col-md-12 text-center">
                              <button type="submit" class="downloadBtn mt-5 btn-height">Download</button>
                          </div>

                      </div>
                  </div>

              </form>
          </div>
      </div>
  </div>
