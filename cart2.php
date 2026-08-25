<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
<title></title>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<link href="//cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css" rel="stylesheet">

<script src="//code.jquery.com/jquery-3.3.1.js"></script>
<script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/localization/messages_zh_TW.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
<script src="datatable4.js"></script>
<!-- Favicon-->
<link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap Icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic"
        rel="stylesheet" type="text/css" />
    <!-- SimpleLightbox plugin CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
<link href="css/styles.css" rel="stylesheet" />
<link href="css/nav.css" rel="stylesheet" />
<style>
body {
    font-family: "微軟正黑體";
}

.error {
    color: #D82424;
    font-weight: normal;
    display: inline;
    padding: 1px;
}
</style>
</head>

<body id="page-top">
<?php include("nav.php"); ?>
    <div style="height: 100px; background-color: black;display: flex; align-items: center; justify-content: center;">
        <h1 style="color: white;">訂單管理</h1>
    </div>
    <div class="row" style="padding-top: 20px;">
        <div class="col-md-2"></div>
        <div class="col-md-8 text-center">
            <form class="form-horizontal form-inline" name="form1" id="form1" method="post">
                <input type="hidden" name="oper" id="oper" value="insert">
                <input type="hidden" name="stud_no_old" id="stud_no_old" value="">
                <table id="edit" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">serial</th>
                            <th class="text-center">launguage</th>
                            <th class="text-center">no</th>
                            <th class="text-center">quantity</th>
                            <th class="text-center">user_name</th>
                            <th class="text-center">存檔/取消</th>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <input type="text" id="serial" name="serial">
                            </td>
                            <td class="text-center">
                                <input type="text" id="stud_name" name="stud_name">
                            </td>
                            <td class="text-center">
                            <input type="text" id="no" name="no">
                            </td>
                            <td class="text-center">
                                <input type="text" id="stud_addr" name="stud_addr">
                            </td>
                            <td class="text-center">
                                <input type="text" id="stud_no" name="stud_no">
                            </td>
                            <td>
                                <button type="submit" class="btn btn-primary btn-xs" id="btn-save"><i class="glyphicon glyphicon-save"></i>存檔</button>
                                <button type="reset" class="btn btn-danger btn-xs" id="btn-cancel">取消</button>
                            </td>
                        </tr>
                    </thead>
                </table>
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">serial</th>
                           <th class="text-center">launguage</th>
                           <th class="text-center">no</th>
                           <th class="text-center">quantity</th>
                           <th class="text-center">user_name</th>
                           <th class="text-center">修改/刪除</th>
                        </tr>
                    </thead>
                </table>
        </div>
        <div class="col-md-2"></div>
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SimpleLightbox plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>