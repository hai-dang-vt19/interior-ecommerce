
<div class="modal fade" id="largeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel3">Danh sách chi phí hàng năm</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th style="color: rgb(231, 171, 6);font-size: 14px">STT</th>
                      <th style="color: rgb(231, 171, 6);font-size: 14px">Chi phí lương</th>
                      <th style="color: rgb(231, 171, 6);font-size: 14px">Chi phí vật liệu</th>
                      <th style="color: rgb(231, 171, 6);font-size: 14px">Chi phí phát sinh</th>
                      <th style="color: rgb(231, 171, 6);font-size: 14px">Năm</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($expense as $k_expense => $expense_tbl)
                    <tr>
                      <td scope="row">{{$k_expense+1}}</td>
                      <td>{{number_format($expense_tbl->expense_salary)}}</td>
                      <td>{{number_format($expense_tbl->expense_material)}}</td>
                      <td>{{number_format($expense_tbl->expense_incurred)}}</td>
                      <td>{{$expense_tbl->years}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
            Đóng
          </button>
        </div>
      </div>
    </div>
</div>
<i class="bx bx-dots-vertical-rounded"
    data-bs-toggle="modal"
    data-bs-target="#largeModal"
    style="cursor: pointer"
></i>