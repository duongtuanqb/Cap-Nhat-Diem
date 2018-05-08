<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv='cache-control' content='no-cache'>
  <meta http-equiv='expires' content='0'>
  <meta http-equiv='pragma' content='no-cache'>
    <title>Buồn đến hao gầy 😔</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
      #diem {max-width: 900px;} 
      body {background-color: #e9ebee;font-family: 'Roboto', sans-serif !important;}
      .hr-wrapper {
        margin: 23px 0;
        position: relative;
    }
    .hr-wrapper span {
        text-transform: uppercase;
        display: inline;
        left: 50%;
        padding: 8px;
        position: absolute;
        top: -16px;
        color: #90949c;
        line-height: 16px;
        background-color: #FFF;
        transform: translate(-50%,0);
    }
  </style>
    <!-- Begin Open Graph metadata -->
  <meta content='Buồn đến hao gầy 😔' property='og:title'/>
  <meta property="article:author" content="https://www.facebook.com/duongtuanqb" />
  <meta property="og:image" content="https://i.imgur.com/i9umQdh.jpg" />
  <!-- <meta property="og:image" content="http://i.imgur.com/uh68Nsm.jpg" /> -->

  <!-- End Open Graph metadata -->

  </head>
  <body>
    <div class="container" id="diem">
      <div class="row">
        <div class="col-xs-12">
          <h1 class="text-center">
            <span v-if="ok">
            <a v-bind:href="'http://sinhvien.tdnu.edu.vn/XemDiem.aspx?MSSV='+mssv" target="_blank">{{ name }}</a></span>
            <span v-else-if="list"><a href="#">Kết quả học tập toàn lớp 14DDS04032 😔</a></span>
            <span v-else><a href="#">Buồn đến hao gầy 😔</a></span>
          </h1>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><span class="glyphicon glyphicon-send" aria-hidden="true"></span> <span v-if="ok">Kết quả học tập của {{ name }}</span>
            <!-- <span v-else-if="list">Kết quả học tập toàn lớp 14DDS04032</span> -->
            <span v-else>Kết quả học tập</span></h3>
              </div>
              <div class="panel-body">
                <div class="alert alert-success" role="alert">
            # Ghi chú: Điểm Giáo dục thể chất 1, Giáo dục thể chất 2, Giáo dục thể chất 3, Giáo dục Quốc phòng không tính vào Trung bình chung tích lũy.<br/>
            <i># Điểm được cập nhật từ sinhvien.tdnu.edu.vn</i>
        </div>
        
                <form action="#" method="POST" role="form" v-on:submit.prevent="onSubmit">
                  <div class="form-group">
                    <label for="MSSV">MSSV</label>
                    <div class="input-group">
                    <div class="input-group-addon"><span aria-hidden="true" class="glyphicon glyphicon-menu-right"></span></div>
                      <input type="text" class="form-control" id="mssv" name="mssv" v-model="mssv" placeholder="Nhập MSSV..." v-bind:disabled="loading" autofocus required>

                      <span class="input-group-btn">
                        <button type="submit" class="btn btn-default" v-bind:disabled="loading"><span v-if="!loading" class="glyphicon glyphicon-ok" aria-hidden="true"></span> <i v-else class="fa fa-spinner fa-spin"></i> {{loading ? 'Loading...' : 'Scan'}} </button>
                        <button v-on:click="diemToanLop" type="button" class="btn btn-success" v-bind:disabled="loading">Lớp 14DDS04032</button>
                      </span>
                    </div>
                  </div>
                </form>
                <div class="alert alert-danger" v-if="error">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <strong>Error!</strong> {{ message_error }}
                </div>

                <div class="text-center" v-if="loading"><img src="fb-loading.gif" alt="loading..." width="32px" height="32px"></div>

              <div class="hr-wrapper" v-if="ok || list"><hr><span>Result</span></div>
              </div>
              <table class="table table-bordered table-hover table-striped" v-if="ok">
                <thead>
                  <tr>
                    <th>Tín chỉ</th>
                    <th>TBC hệ 10</th>
                    <th>TBC hệ 4</th>
                    <th>Số môn A+</th>
                    <th>Số môn A</th>
                    <th>Số môn B+</th>
                    <th>Số môn B</th>
                    <th>Số môn C+</th>
                    <th>Số môn C</th>
                    <th>Số môn D+</th>
                    <th>Số môn D</th>
                    <th>Số môn F</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>{{ ketqua.tongtinchi }}</td>
                    <td>{{ ketqua.tbche10 }}</td>
                    <td>{{ ketqua.tbche4 }}</td>
                    <td>{{ ketqua.somonaplus }}</td>
                    <td>{{ ketqua.somona }}</td>
                    <td>{{ ketqua.somonbplus }}</td>
                    <td>{{ ketqua.somonb }}</td>
                    <td>{{ ketqua.somoncplus }}</td>
                    <td>{{ ketqua.somonc }}</td>
                    <td>{{ ketqua.somondplus }}</td>
                    <td><strong><font style="color:rgb(39, 188, 197);">{{ ketqua.somond }}</font></strong></td>
                    <td><strong><font style="color:red">{{ ketqua.somonf }}</font></strong></td>
                  </tr>
                </tbody>
              </table>
              <table class="table table-bordered table-hover table-striped" v-if="list">
                <thead>
                  <tr>
                    <!-- <th>MSSV</th> -->
                    <th>Sinh viên</th>
                    <!-- <th>Tín chỉ</th> -->
                    <th>TBC hệ 10</th>
                    <th>TBC hệ 4</th> 
                    <th>A+</th>
                    <th>A</th>
                    <th>B+</th>
                    <th>B</th>
                    <th>C+</th>
                    <th>C</th>
                    <th>D+</th>
                    <th>D</th>
                    <th>F</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="ds in orderedList">
                    <!-- <td>{{ ds.mssv }}</td> -->
                    <td><a v-bind:href="'http://sinhvien.tdnu.edu.vn/XemDiem.aspx?MSSV='+ds.mssv" target="_blank">{{ ds.name }}</a></td>
                    <!-- <td>{{ ds.tongtinchi }}</td> -->
                    <td>{{ ds.tbche10 }}</td>
                    <td>{{ ds.tbche4 }}</td>
                    <td>{{ ds.somonaplus }}</td>
                    <td>{{ ds.somona }}</td>
                    <td>{{ ds.somonbplus }}</td>
                    <td>{{ ds.somonb }}</td>
                    <td>{{ ds.somoncplus }}</td>
                    <td>{{ ds.somonc }}</td>
                    <td>{{ ds.somondplus }}</td>
                    <td><strong><font style="color:rgb(39, 188, 197);">{{ ds.somond }}</font></strong></td>
                    <td><strong><font style="color:red">{{ ds.somonf }}</font></strong></td>
                  </tr>
                </tbody>
              </table>
              <div class="panel-footer text-center">
                <font style="color: #ff005e">❤</font> by <a href="https://www.facebook.com/duongtuanqb">#DAt</a>
              </div>
          </div>
        </div>
      </div>
    </div>
    <div class="text-center">
        <script id="_wau77m">var _wau = _wau || []; _wau.push(["small", "qhj56u8ach4n", "77m"]);(function() {var s=document.createElement("script"); s.async=true;s.src="//widgets.amung.us/small.js";document.getElementsByTagName("head")[0].appendChild(s);})();</script>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/vue"></script>
    <script src="https://unpkg.com/vue-resource"></script>

    <script src="main.js?v=6.2"></script>
  </body>
</html>
