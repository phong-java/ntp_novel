<div class="card">
    <div class="card-header">Đánh giá</div>

    <div class="container text-body">
        <div class="row d-flex justify-content-center">
            <div class="d-flex flex-start w-100">
                <img class="rounded-circle shadow-1-strong me-3"
                  src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(21).webp" alt="avatar" width="65"
                  height="65" />
                <div class="w-100">
                  <h5>Add a comment</h5>
                  <ul class="rating mb-3 list-inline d-flex gap-2" data-mdb-toggle="rating">
                    <li>
                      <i class="far fa-star fa-sm text-danger" title="Bad"></i>
                    </li>
                    <li>
                      <i class="far fa-star fa-sm text-danger" title="Poor"></i>
                    </li>
                    <li>
                      <i class="far fa-star fa-sm text-danger" title="OK"></i>
                    </li>
                    <li>
                      <i class="far fa-star fa-sm text-danger" title="Good"></i>
                    </li>
                    <li>
                      <i class="far fa-star fa-sm text-danger" title="Excellent"></i>
                    </li>
                  </ul>
                  <div data-mdb-input-init class="form-outline mb-3">
                    <textarea class="form-control" id="textAreaExample" rows="4"></textarea>
                  </div>
                  <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-success">
                    Đăng <i class="fas fa-long-arrow-alt-right ms-1"></i>
                  </button>
                </div>
              </div>
        </div>
      </div>
    <div class="card-body">
        <div class="overflow-auto ntp_custom_ver_scrollbar" style="height: 500px;">
            <?php
                for ($i=1; $i <= 50; $i++) { 
                    ?>
    <div class="container my-2 text-body">
        <div class="row d-flex justify-content-center">
            <div class="d-flex flex-start mb-4">
                <img class="rounded-circle shadow-1-strong me-3"
                  src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(32).webp" alt="avatar" width="65"
                  height="65" />
                <div class="card w-100">
                  <div class="">
                      <div class="p-4">
                          <h5>Johny Cash</h5>
                          <p class="small">3 hours ago</p>
                          <p>
                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque
                            ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus
                            viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla.
                            Donec lacinia congue felis in faucibus ras purus odio, vestibulum in
                            vulputate at, tempus viverra turpis.
                          </p>
          
                          <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                              <a href="#!" class="link-muted me-2"><i class="fas fa-thumbs-up me-1"></i>132</a>
                              <a href="#!" class="link-muted"><i class="fas fa-thumbs-down me-1"></i>15</a>
                            </div>
                            <a href="#!" class="link-muted"><i class="fas fa-reply me-1"></i> Reply</a>
                          </div>
                        </div>
                  </div>
                </div>
              </div>
        </div>
      </div>
            <?php
                }
            ?>
        </div>
    </div>
</div>
