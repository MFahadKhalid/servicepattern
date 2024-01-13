<div class="modal fade" id="EditCountry" tabindex="-1" aria-labelledby="EditCountryLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="updateCountry">
            <div class="modal-header">
            <h5 class="modal-title" id="EditCountryLabel">Edit Country</h5>
            <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="mb-3 col-md-12">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="phonecode">Phone code <span class="text-danger">*</span></label>
                        <input type="number" name="phonecode" id="phonecode" class="form-control" required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="code">Code <span class="text-danger">*</span></label>
                        <input type="text" name="code" id="code" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
      </div>
    </div>
  </div>
