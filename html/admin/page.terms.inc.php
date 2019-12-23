<?php

    if (!admin::isSession()) {

        header("Location: /admin/login");
        exit;
    }

    $gift = new gift($dbo);

    $error = false;
    $error_message = '';

    if (!empty($_POST)) {

        $authToken = isset($_POST['authenticity_token']) ? $_POST['authenticity_token'] : '';

        if ($authToken === helper::getAuthenticityToken() && !APP_DEMO) {

            if (isset($_FILES['uploaded_file']['name'])) {
 
                $uploaded_file = $_FILES['uploaded_file']['tmp_name'];
                $uploaded_file_name = basename($_FILES['uploaded_file']['name']);
                $uploaded_file_ext = pathinfo($_FILES['uploaded_file']['name'], PATHINFO_EXTENSION);

                $action = isset($_POST['action']) ? $_POST['action'] : '';
                $action = helper::clearText($action);
                $action = helper::escapeText($action);

                $files = glob(TERMS_PATH.$action.'*'); // get all file names
                foreach($files as $file){ // iterate files
                    if(is_file($file)) {
                        unlink($file); // delete file
                    }
                }

                if (move_uploaded_file($_FILES['uploaded_file']['tmp_name'], TERMS_PATH.$action.$uploaded_file_name)) {
                    //$gift->db_add($cost, $category, APP_URL."/".TERMS_PATH.$terms_next_id.".".$uploaded_file_ext);
                }
            }
        }

        header("Location: /admin/terms");
        exit;
    }

    $page_id = "terms";

    helper::newAuthenticityToken();

    $css_files = array("mytheme.css");
    $page_title = "Terms&Condition | Admin Panel";

    include_once("../html/common/admin_header.inc.php");
?>

<body class="fix-header fix-sidebar card-no-border">

    <div id="main-wrapper">

        <?php

            include_once("../html/common/admin_topbar.inc.php");
        ?>

        <?php

            include_once("../html/common/admin_sidebar.inc.php");
        ?>

        <div class="page-wrapper">

            <div class="container-fluid">

                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor">Dashboard</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/admin/main">Home</a></li>
                            <li class="breadcrumb-item active">Terms & Condition</li>
                        </ol>
                    </div>
                </div>

                <?php

                    include_once("../html/common/admin_banner.inc.php");
                ?>

                <div class="row">

                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">1. Agreement Types- Contract Papers, e.g.:  Non- Registered Deed.</h4>

                                <form class="form-material m-t-40"  method="post" action="/admin/terms" enctype="multipart/form-data">

                                    <input type="hidden" name="authenticity_token" value="<?php echo helper::getAuthenticityToken(); ?>">
                                    <input type="hidden" name="action"  value="1/">

                                    <div class="form-group">
                                        <?php 
                                            
                                            if ( count(glob(TERMS_PATH.'1/*')) > 0 ) {
                                                foreach( glob(TERMS_PATH.'1/*') as $fileName){ // iterate files
                                                    if(is_file($fileName)) {
                                                        echo '<label>File : '.basename($fileName).'</label>';
                                                    }
                                                }
                                            } else {
                                                echo '<label>File : No</label>';
                                            }
                                            
                                        ?>

                                        <input name="uploaded_file" type="file" class="form-control" id="exampleInputFile" aria-describedby="fileHelp">
                                    </div>

                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <button class="btn btn-info text-uppercase waves-effect waves-light" type="submit">Upload</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">2. Biz Connect/Entrepreneur Connect - Terms of use Policy.</h4>

                                <form class="form-material m-t-40"  method="post" action="/admin/terms" enctype="multipart/form-data">

                                    <input type="hidden" name="authenticity_token" value="<?php echo helper::getAuthenticityToken(); ?>">
                                    <input type="hidden" name="action"  value="2/">
                                    <div class="form-group">
                                        <?php 
                                            
                                            if ( count(glob(TERMS_PATH.'2/*')) > 0 ) {
                                                foreach( glob(TERMS_PATH.'2/*') as $fileName){ // iterate files
                                                    if(is_file($fileName)) {
                                                        echo '<label>File : '.basename($fileName).'</label>';
                                                    }
                                                }
                                            } else {
                                                echo '<label>File : No</label>';
                                            }
                                            
                                        ?>
                                        <input name="uploaded_file" type="file" class="form-control" id="exampleInputFile" aria-describedby="fileHelp">
                                    </div>

                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <button class="btn btn-info text-uppercase waves-effect waves-light" type="submit">Upload</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">3. Contract Papers - Agents, Marchant, iC- Cafe Owners, Contractors.</h4>

                                <form class="form-material m-t-40"  method="post" action="/admin/terms" enctype="multipart/form-data">

                                    <input type="hidden" name="authenticity_token" value="<?php echo helper::getAuthenticityToken(); ?>">
                                    <input type="hidden" name="action"  value="3/">
                                    <div class="form-group">
                                        <?php 
                                            
                                            if ( count(glob(TERMS_PATH.'3/*')) > 0 ) {
                                                foreach( glob(TERMS_PATH.'3/*') as $fileName){ // iterate files
                                                    if(is_file($fileName)) {
                                                        echo '<label>File : '.basename($fileName).'</label>';
                                                    }
                                                }
                                            } else {
                                                echo '<label>File : No</label>';
                                            }
                                            
                                        ?>
                                        <input name="uploaded_file" type="file" class="form-control" id="exampleInputFile" aria-describedby="fileHelp">
                                    </div>

                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <button class="btn btn-info text-uppercase waves-effect waves-light" type="submit">Upload</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">4. Medical Services Terms.</h4>

                                <form class="form-material m-t-40"  method="post" action="/admin/terms" enctype="multipart/form-data">

                                    <input type="hidden" name="authenticity_token" value="<?php echo helper::getAuthenticityToken(); ?>">
                                    <input type="hidden" name="action"  value="4/">
                                    <div class="form-group">
                                        <?php 
                                            
                                            if ( count(glob(TERMS_PATH.'4/*')) > 0 ) {
                                                foreach( glob(TERMS_PATH.'4/*') as $fileName){ // iterate files
                                                    if(is_file($fileName)) {
                                                        echo '<label>File : '.basename($fileName).'</label>';
                                                    }
                                                }
                                            } else {
                                                echo '<label>File : No</label>';
                                            }
                                            
                                        ?>
                                        <input name="uploaded_file" type="file" class="form-control" id="exampleInputFile" aria-describedby="fileHelp">
                                    </div>

                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <button class="btn btn-info text-uppercase waves-effect waves-light" type="submit">Upload</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">5. Other Terms / Documents</h4>

                                <form class="form-material m-t-40"  method="post" action="/admin/terms" enctype="multipart/form-data">

                                    <input type="hidden" name="authenticity_token" value="<?php echo helper::getAuthenticityToken(); ?>">
                                    <input type="hidden" name="action"  value="5/">
                                    <div class="form-group">
                                        <?php 
                                            
                                            if ( count(glob(TERMS_PATH.'5/*')) > 0 ) {
                                                foreach( glob(TERMS_PATH.'5/*') as $fileName){ // iterate files
                                                    if(is_file($fileName)) {
                                                        echo '<label>File : '.basename($fileName).'</label>';
                                                    }
                                                }
                                            } else {
                                                echo '<label>File : No</label>';
                                            }
                                            
                                        ?>
                                        <input name="uploaded_file" type="file" class="form-control" id="exampleInputFile" aria-describedby="fileHelp">
                                    </div>

                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <button class="btn btn-info text-uppercase waves-effect waves-light" type="submit">Upload</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>

                </div>

            </div> <!-- End Container fluid  -->

            <?php

                include_once("../html/common/admin_footer.inc.php");
            ?>

        </div> <!-- End Page wrapper  -->
    </div> <!-- End Wrapper -->

</body>

</html>

