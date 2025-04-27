<div class="container-fluid">
  <div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Doanh thu tháng này</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= isset($data_countM['Count']) ? number_format($data_countM['Count']) : '0' ?> VNĐ</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Doanh thu năm nay</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= isset($data_countY['Count']) ? number_format($data_countY['Count']) : '0' ?> VNĐ</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Khách hàng</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= isset($data_nguoidung['Count']) ? $data_nguoidung['Count'] : '0' ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Nhân viên</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= isset($data_nhanvien['Count']) ? $data_nhanvien['Count'] : '0' ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Điện thoại</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= isset($data_tksp1['Count']) ? $data_tksp1['Count'] : '0' ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Phụ kiện</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= isset($data_tksp2['Count']) ? $data_tksp2['Count'] : '0' ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tablet</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= isset($data_tksp3['Count']) ? $data_tksp3['Count'] : '0' ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Laptop</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= isset($data_tksp4['Count']) ? $data_tksp4['Count'] : '0' ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Đơn hàng chưa duyệt</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= isset($data_hd['Count']) ? $data_hd['Count'] : '0' ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-comments fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row mb-4">
    <div class="col-lg-12">
      <div class="card shadow">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Thống kê theo khoảng thời gian</h6>
        </div>
        <div class="card-body">
          <form method="post" action="" class="form-inline mb-4">
            <div class="form-group mx-sm-3 mb-2">
              <label for="start_date" class="mr-2">Từ ngày:</label>
              <input type="date" class="form-control" id="start_date" name="start_date" value="<?= isset($_POST['start_date']) ? $_POST['start_date'] : '' ?>" required>
            </div>
            <div class="form-group mx-sm-3 mb-2">
              <label for="end_date" class="mr-2">Đến ngày:</label>
              <input type="date" class="form-control" id="end_date" name="end_date" value="<?= isset($_POST['end_date']) ? $_POST['end_date'] : '' ?>" required>
            </div>
            <button type="submit" name="filter_stats" class="btn btn-primary mb-2">Xem thống kê</button>
          </form>
          
          <?php
          if(isset($_POST['filter_stats'])) {
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            
            if(isset($period_orders) && isset($period_revenue) && isset($daily_stats)) {
          ?>
          
          <div class="row mb-4">
            <div class="col-md-6">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Tổng số đơn hàng</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($period_orders) ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tổng doanh thu</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($period_revenue) ?> VNĐ</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Ngày</th>
                  <th>Số đơn hàng</th>
                  <th>Doanh thu</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($daily_stats as $day): ?>
                <tr>
                  <td><?= $day['date'] ?></td>
                  <td><?= number_format($day['orders']) ?></td>
                  <td><?= number_format($day['revenue']) ?> VNĐ</td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          
          <?php
            } else {
              echo '<div class="alert alert-info">Không có dữ liệu cho khoảng thời gian này.</div>';
            }
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>