  <!-- Modal (Question with Answer) -->
  <div class="modal fade" id="modalSecondmodel" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
      role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
          <div class="modal-content" id="downloadModal">
              <div class="text-end py-2">
                  <button type="button" class="modalCloseBtn" data-bs-dismiss="modal" aria-label="Close">
                      <i class="bi bi-x"></i>
                  </button>
              </div>
              <div class="text-center p-4 modal-title-pos">
                  <h5 class="modal-title" id="modalTitleId">Please Contact To How Tests Administration For Explanation
                  </h5>
              </div>
              @csrf
              <div class="modal-body">
                  <div class="row text-center">
                      <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                          <div class="mb-3">
                              <a href="">
                                  <button class='contactBtn btn-height'><i class="bi bi-whatsapp mx-1"></i>Contact On
                                      WhatsApp</button>
                              </a>
                          </div>
                      </div>
                      <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                          <div class="mb-3">
                              <a href="">

                                  <button class='contactBtn btn-height'><i class="bi bi-envelope mx-1"></i>Contact via
                                      Email</button>
                              </a>
                          </div>
                      </div>


                  </div>
              </div>

          </div>
      </div>
  </div>
