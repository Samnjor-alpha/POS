<?php include 'regprocess.php';


?>



<!DOCTYPE html>
<html>

<head>
    <!-- Meta and Title -->
    <meta charset="utf-8">
    <title>POS </title>
    <meta name="keywords" content="pos,sale,check out"/>
    <meta name="description" content="Point Of Sale">
    <meta name="author" content="ThemeREX">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<? include '../public/styles.php'?>

</head>

<body class="utility-page sb-l-c sb-r-c">


<!-- Body Wrap -->
<div id="main" class="animated fadeIn">

    <!-- Main Wrapper -->
    <section id="content_wrapper">

        <div id="canvas-wrapper">
            <canvas id="demo-canvas"></canvas>
        </div>

        <!-- Content -->
        <section id="content" class="">

            <!-- Registration -->
            <div class="allcp-form theme-primary mw600" >
                <div class="bg-primary mw600 text-center mb20 br3 pt15 pb10">
                    <img src="../assets/img/logo.png" alt=""/>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading pn">
                                    <span class="panel-title">
                                      Registration form
                                    </span>
                    </div>
                    <!-- /Panel Heading -->

                    <form method="post" action="" >
                        <div class="panel-body pn">
                            <div class="section row mh10m">
                                <div class="col-md-6 ph10">
                                    <label for="firstname" class="field prepend-icon">
                                        <input required type="text" name="firstname" id="firstname"
                                               class="gui-input"
                                               placeholder="First name...">
                                        <span class="field-icon">
                                            <i class="fa fa-user"></i>
                                        </span>
                                    </label>
                                </div>
                                <!-- /section -->

                                <div class="col-md-6 ph10">
                                    <label for="lastname" class="field prepend-icon">
                                        <input required type="text" name="lastname" id="lastname" class="gui-input"
                                               placeholder="Last name...">
                                        <span class="field-icon">
                                            <i class="fa fa-user"></i>
                                        </span>
                                    </label>
                                </div>
                                <!-- /section -->
                            </div>
                            <!-- /section -->

                            <div class="section">
                                <label for="email" class="field prepend-icon">
                                    <input required type="email" name="email" id="email" class="gui-input"
                                           placeholder="Email address">
                                    <span class="field-icon">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                </label>
                            </div>
                            <!-- /section -->

                            <div class="section">
                                <label for="username" class="field prepend-icon">
                                    <input required type="text" name="username" id="username"  onblur="checkAvailability()" class="gui-input"
                                           placeholder="username">
                                    <span id="user-availability-status"></span>
                                    <span class="field-icon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </label>
                            </div>
                            <!-- /section -->

                            <div class="section">
                                <label for="password" class="field prepend-icon">
                                    <input required type="password" name="password" id="password" class="gui-input"
                                           placeholder="Create a password">
                                    <span class="field-icon">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                </label>
                            </div>
                            <!-- /section -->

                            <div class="section">
                                <label for="confirmPassword" class="field prepend-icon">
                                    <input required type="password" name="confirmPassword" id="confirmPassword"
                                           class="gui-input"
                                           placeholder="Retype your password">
                                    <span class="field-icon">
                                        <i class="fa fa-unlock-alt"></i>
                                    </span>
                                </label>
                            </div>
                            <!-- /section -->

                            <div class="section">


                                    <button type="submit" name="reg" class="btn btn-block btn-bordered btn-primary">Create Account
                                    </button>

                            </div>
                            <!-- /section -->
                            <?php if (!empty($msg)): ?>
                                <div class="alert <?php echo $msg_class ?>" role="alert">
                                    <?php echo $msg; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <!-- /Form -->
                        <div class="panel-footer">

                        </div>
                        <!-- /Panel Footer -->
                    </form>
                </div>
            </div>
            <!-- /Spec Form -->

        </section>
        <!-- /Content -->

    </section>


</div>

<? include '../public/scripts.php'?>

<!-- /Scripts -->

</body>

</html>


