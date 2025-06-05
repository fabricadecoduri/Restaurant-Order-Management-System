<h1 style="margin-top:98px">Welcome back <b><?php echo $_SESSION['adminusername']; ?></b></h1>
<?php
function charts_circle (){
  echo '
  <!-- cart container -->
  <div class="chart-container container mb-5">
      <div class="row">
          <div class="col-10 offset-1">
              <div class="grid" id="charts_row">
                </div>
          </div>
      </div>
  </div>';
  }