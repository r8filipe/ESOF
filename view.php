<?php
session_start();

if (isset($_POST['method'])) {
    if ($_POST['method'] == 'searchTo') {
        $destino = $_POST['destino'];
        $distancia = $_POST['distancia'];
        $response = file_get_contents('http://localhost:8080/esof/ws2.php?method=searchTo&destino=' . $destino . '&distancia=' . $distancia);
    }
}
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Modern Business - Start Bootstrap Template</title>

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/modern-business.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!-- MetisMenu CSS -->
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/metisMenu/2.2.0/metisMenu.min.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->


    </head>

    <body>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Start Bootstrap</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">


        <!-- Service Tabs -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">BACKEND</h2>
            </div>
            <div class="col-lg-12">

                <div id="myTabContent" class="tab-content" style="margin-top:25px;">
                    <div class="tab-pane fade active in">
                        <ul class="metismenu" id="menu">
                            <li class="sidebar-search ">
                                <a href="#" style="font-size:1.2em"><i class="fa fa-money"></i></i>
                                    Procurar Percursos<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <div class="panel-body">
                                            <form action="" role="form" id="myform" method="post">
                                                <div class="control-group form-group">
                                                    <div class="controls">
                                                        <label>Destino (RUA Localidade ou Codigo Postal)</label>
                                                        <input type="text" class="form-control" name="destino"
                                                               id="destino"
                                                               required=""
                                                               data-validation-required-message="Destino."
                                                               aria-invalid="false">
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                                <div class="control-group form-group">
                                                    <div class="controls">
                                                        <label>Distancia Aceitavel KM</label>
                                                        <input type="number" class="form-control" name="distancia"
                                                               id="distancia"
                                                               required=""
                                                               data-validation-required-message="Distancia em Km."
                                                               aria-invalid="false">
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>

                                                <button type="submit" class="btn btn-primary" id="btnadd"
                                                        name="method" value="searchTo">Procurar
                                                </button>
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                </div>

            </div>
        </div>

        <hr>
        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/metisMenu/2.2.0/metisMenu.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#menu").metisMenu({
                toggle: false
            });

        });
    </script>
    </body>

    </html>
<?php
session_destroy();
session_unset();
?>