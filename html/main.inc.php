<?php

    /*!
     * ifsoft.co.uk
     *
     * http://ifsoft.com.ua, http://ifsoft.co.uk, https://raccoonsquare.com
     * raccoonsquare@gmail.com
     *
     * Copyright 2012-2019 Demyanchuk Dmitry (raccoonsquare@gmail.com)
     */

    if (auth::isSession()) {

        header("Location: /account/wall");
    }

    $user_username = '';

    $error = false;
    $error_message = '';

    if (!empty($_POST)) {

        $user_username = isset($_POST['user_username']) ? $_POST['user_username'] : '';
        $user_password = isset($_POST['user_password']) ? $_POST['user_password'] : '';
        $token = isset($_POST['authenticity_token']) ? $_POST['authenticity_token'] : '';

        $user_username = helper::clearText($user_username);
        $user_password = helper::clearText($user_password);

        $user_username = helper::escapeText($user_username);
        $user_password = helper::escapeText($user_password);

        if (auth::getAuthenticityToken() !== $token) {

            $error = true;
        }

        if (!$error) {

            $access_data = array();

            $account = new account($dbo);

            $access_data = $account->signin($user_username, $user_password);

            unset($account);

            if (!$access_data['error']) {

                $account = new account($dbo, $access_data['accountId']);
                $accountInfo = $account->get();

                //print_r($accountInfo);

                switch ($accountInfo['state']) {

                    case ACCOUNT_STATE_BLOCKED: {

                        break;
                    }

                    default: {

                        $account->setState(ACCOUNT_STATE_ENABLED);

                        $clientId = 0; // Desktop version

                        $auth = new auth($dbo);
                        $access_data = $auth->create($accountInfo['id'], $clientId, APP_TYPE_WEB, "", $LANG['lang-code']);

                        if (!$access_data['error']) {

                            auth::setSession($access_data['accountId'], $accountInfo['username'], $accountInfo['fullname'], $accountInfo['lowPhotoUrl'], $accountInfo['verified'], $accountInfo['access_level'], $access_data['accessToken']);
                            auth::updateCookie($user_username, $access_data['accessToken']);

                            unset($_SESSION['oauth']);
                            unset($_SESSION['oauth_id']);
                            unset($_SESSION['oauth_name']);
                            unset($_SESSION['oauth_email']);
                            unset($_SESSION['oauth_link']);

                            $account->setLastActive();

                            header("Location: /");
                        }
                    }
                }

            } else {

                $error = true;
            }
        }
    }

    auth::newAuthenticityToken();

    $page_id = "main";

    $css_files = array("landing.css", "my.css");
    $page_title = APP_TITLE;

    include_once("../html/common/header.inc.php");

?>

<body class="home">

    <?php

        include_once("../html/common/topbar.inc.php");
    ?>

    <div class="content-page">

        <div class="limiter">
            <div class="container-login100">
                <div class="wrap-login100">

                    <form accept-charset="UTF-8" action="/" class="custom-form login100-form" id="login-form" method="post">

                        <input autocomplete="off" type="hidden" name="authenticity_token" value="<?php echo helper::getAuthenticityToken(); ?>">

                        <span class="login100-form-title " style="padding-bottom: 60px;"><?php echo $LANG['page-login']; ?></span>

                        <?php

                        if (FACEBOOK_AUTHORIZATION) {

                            ?>

                            <p style="margin-bottom: 0px;">
                                <a class="fb-icon-btn fb-btn-large btn-facebook" href="/facebook/login">
                                    <span class="icon-container">
                                        <i class="icon fa fa-facebook fa-fw"></i>
                                    </span>
                                    <span><?php echo $LANG['action-login-with']." ".$LANG['label-facebook']; ?></span>
                                </a>
                                <div class="btn-group" role="group" aria-label="Basic example" style="width:100%;margin-bottom: 1rem;">
                                    <button type="button" class="btn btn-secondary" style="background-color: #55ACEE;padding: 7px 0px;"><?php echo $LANG['action-login-with'] ?></button>
                                    <button type="button" class="btn btn-secondary" style="background-color: #dd4b39;padding: 0px;"><i class="icon fa fa-google fa-fw" style="font-size: 24px;"></i></button>
                                    <button type="button" class="btn btn-secondary" style="background-color: #55ACEE;padding: 0px;"><i class="icon fa fa-twitter fa-fw" style="font-size: 24px;"></i></button>
                                    <button type="button" class="btn btn-secondary" style="background-color: #007BB6;padding: 0px;"><i class="icon fa fa-linkedin fa-fw" style="font-size: 24px;"></i></button>
                                    <button type="button" class="btn btn-secondary" style="background-color: #F7931E;padding: 0px;"><i class="icon fa fa-instagram fa-fw" style="font-size: 24px;"></i></button>
                                </div>
                            </p>

                            <?php
                        }
                        ?>

                        <div class="errors-container" style="<?php if (!$error) echo "display: none"; ?>">
                            <p class="title"><?php echo $LANG['label-errors-title']; ?></p>
                            <ul>
                                <li><?php echo $LANG['msg-error-authorize']; ?></li>
                            </ul>
                        </div>

                        <input id="username" name="user_username" placeholder="<?php echo $LANG['label-username']; ?>" required="required" size="30" type="text" value="<?php echo $user_username; ?>">
                        <input id="password" name="user_password" placeholder="<?php echo $LANG['label-password']; ?>" required="required" size="30" type="password" value="">

                        <div class="login-button">
                            <input style="margin-right: 10px" class="submit-button button blue" name="commit" type="submit" value="<?php echo $LANG['action-login']; ?>">
                            <a href="/remind" class="help"><?php echo $LANG['action-forgot-password']; ?></a>
                        </div>
                    </form>

                    <div class="login100-more">
                        <div class="login100_content" style="width: 100%;">
                            <h1 class="mb-10" style="font-size:32px">CURIOUS? JOIN US</h1>
                            <img src="/img/qr_code.png" class="rounded mx-auto d-block" alt="QR Code">

                            <div style="width:100%; margin-top: 20px;">
                                <a href="#" style="">
                                    <img alt='Download on the App Store' src='img/app_store_badge.png' style="width:49%"/>
                                </a>
                                <a href='https://play.google.com/store/apps/details?id=com.factabiz.app&pcampaignid=pcampaignidMKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1'  style="">
                                    <img alt='Get it on Google Play' src='img/google-play-badge.png' style="width:49%"/>
                                </a>
                            </div>
                            
                            
                            
                        </div>
                            
                    </div>

                </div>

            </div>

            <?php

                include_once("../html/common/footer.inc.php");
            ?>

        </div>


    </div>



</body
</html>