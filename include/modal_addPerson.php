<!-- Modal -->
<div class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Person</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post">
          <div class="input-group mb-4">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-user bigicon"></i></span>
            </div>
            <input id="fname" name="Name" type="text" placeholder="Firstname" class="form-control" required="">
          </div>
          <div class="input-group mb-4">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-user bigicon"></i></span>
            </div>
            <input id="fname" name="Middlename" type="text" placeholder="Middlename" class="form-control" required="">
          </div>
          <div class="input-group mb-4">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-user bigicon"></i></span>
            </div>
            <input id="fname" name="Lastname" type="text" placeholder="Lastname" class="form-control" required="">
          </div>
          <div class="input-group mb-4">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-paper-plane"></i></span>
            </div>
            <input id="fname" name="Age" type="number" placeholder="Age" class="form-control" required="">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputGroupSelect01">Gender</label>
            </div>
            <select name="Gender" class="custom-select" id="inputGroupSelect01">
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
          </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="addPerson" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>