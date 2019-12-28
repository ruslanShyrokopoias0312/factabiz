<?php

/*!
 * ifsoft.co.uk
 *
 * http://ifsoft.com.ua, http://ifsoft.co.uk, https://raccoonsquare.com
 * raccoonsquare@gmail.com
 *
 * Copyright 2012-2019 Demyanchuk Dmitry (raccoonsquare@gmail.com)
 */

?>

    <div class="modal fade" id="langModal" tabindex="-1" role="dialog" aria-labelledby="langModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="langModal"><?php echo $LANG['page-language']; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php

                        foreach ($LANGS as $name => $val) {

                            echo "<a onclick=\"App.setLanguage('$val'); return false;\" class=\"box-menu-item \" href=\"javascript:void(0)\">$name</a>";
                        }

                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn blue" data-dismiss="modal"><?php echo $LANG['action-close']; ?></button>
                </div>
            </div>
        </div>
    </div>

    <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls " style="display: none;">
        <div class="slides" style="width: 2048px;"></div>
        <h3 class="title hidden"></h3>
        <a class="prev text-light">‹</a>
        <a class="next text-light">›</a>
        <a class="close text-light">×</a>
        <a class="play-pause"></a>
        <ol class="indicator"></ol>
    </div>

    <div id="modal-section"></div>

    <div id="main-footer">

        <div class="wrap">

            <div id="footer-nav" class="mt-5 pt-5 pb-5 footer">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-xs-12">
                            <h4 class="mt-lg-0 mt-sm-3">Link 1</h4>
                            <ul class="m-0 p-0 list-group">
                                <li>- <a href="/about"><?php echo $LANG['footer-about']; ?></a></li>
                                <li>- <a href="#">iC-Cafe</a></li>
                                <li>- <a href="#">iC-Cafe Map</a></li>
                                <li>- <a href="#">Biz Connect</a></li>
                                <li>- <a href="#">Facta POST</a></li>
                                <li>- <a href="#">Factabiz Heroes</a></li>
                                <li>- <a href="#">Social Heroes</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-3 col-xs-12">
                            <h4 class="mt-lg-0 mt-sm-3">Link 2</h4>
                            <ul class="m-0 p-0 list-group">
                                <li>- <a href="#">Bengali</a></li>
                                <li>- <a class="lang_link" href="javascript:void(0)"  data-toggle="modal" data-target="#langModal"><?php echo $LANG['lang-name']; ?></a></li>
                                <li>- <a href="#">All Languages</a></li>
                                <li>- <a href="/gdpr"><?php echo $LANG['footer-gdpr']; ?></a></li>
                                <li>- <a href="#">Create Ad</a></li>
                                <li>- <a href="#">Asian Version</a></li>
                                <li>- <a href="#">Other Versions</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-3 col-xs-12">
                            <h4 class="mt-lg-0 mt-sm-3">Link 3</h4>
                            <ul class="m-0 p-0 list-group">
                                <li>- <a href="#">Legal Services</a></li>
                                <li>- <a href="#">Locker Service</a></li>
                                <li>- <a href="#">Other Services</a></li>
                                <li>- <a href="/terms"><?php echo $LANG['footer-terms']; ?></a></li>
                                <li>- <a href="#">Cockies Policy</a></li>
                                <li>- <a href="#">Help</a></li>
                                <li>- <a href="/support"><?php echo $LANG['footer-support']; ?></a></li>
                            </ul>
                        </div>
                        <div class="col-lg-3 col-xs-12">
                        <h4 class="mt-lg-0 mt-sm-4">Location</h4>
                        <p>22, Lorem ipsum dolor, consectetur adipiscing</p>
                        <p class="mb-0"><i class="fa fa-phone mr-3"></i>(123) 456-7890</p>
                        <p><i class="fa fa-envelope-o mr-3"></i>factabiz@gmail.com</p>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div id="footer-copyright" class="col">
                        <p class="">© <?php echo APP_YEAR; ?> <?php echo APP_TITLE; ?></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script type="text/javascript" src="/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="/js/drawer.js"></script>

    <script type="text/javascript" src="/js/common.js?x44"></script>

    <script type="text/javascript" src="/js/jquery.colorbox.js?x=30"></script>
    <script type="text/javascript" src="/js/jquery.autosize.js?x=30"></script>
    <script type="text/javascript" src="/js/jquery.cookie.js?x=30"></script>
    <script type="text/javascript" src="/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="/js/load-image.all.min.js"></script>
    <script type="text/javascript" src="/js/jquery.ui.widget.js"></script>
    <script type="text/javascript" src="/js/jquery.iframe-transport.js"></script>
    <script type="text/javascript" src="/js/jquery.fileupload.js"></script>
    <script type="text/javascript" src="/js/jquery.fileupload-process.js"></script>
    <script type="text/javascript" src="/js/jquery.fileupload-image.js"></script>
    <script type="text/javascript" src="/js/jquery.fileupload-validate.js"></script>
    <script type="text/javascript" src="/js/blueimp-gallery.js"></script>

    <script type="text/javascript">

        var options = {

            pageId: "<?php echo $page_id; ?>",
            api_version: "<?php echo API_VERSION; ?>",
            post_max_images: <?php echo POST_MAX_IMAGES_COUNT; ?>
        };

        var constants = {
            MAX_FILE_SIZE: 3145728
        };

        var account = {

            id: "<?php echo auth::getCurrentUserId(); ?>",
            username: "<?php echo auth::getCurrentUserLogin(); ?>",
            accessToken: "<?php echo auth::getAccessToken(); ?>"
        };

        var strings = {

            sz_action_follow: "<?php echo $LANG['action-follow']; ?>",
            sz_action_unfollow: "<?php echo $LANG['action-unfollow']; ?>",
            sz_action_login: "<?php echo $LANG['action-login']; ?>",
            sz_action_signup: "<?php echo $LANG['action-signup']; ?>",
            sz_action_block: "<?php echo $LANG['action-block']; ?>",
            sz_action_unblock: "<?php echo $LANG['action-unblock']; ?>",
            sz_action_close: "<?php echo $LANG['action-close']; ?>",
            sz_action_report: "<?php echo $LANG['action-report']; ?>",
            sz_report_reason_1: "<?php echo $LANG['label-profile-report-reason-1']; ?>",
            sz_report_reason_2: "<?php echo $LANG['label-profile-report-reason-2']; ?>",
            sz_report_reason_3: "<?php echo $LANG['label-profile-report-reason-3']; ?>",
            sz_report_reason_4: "<?php echo $LANG['label-profile-report-reason-4']; ?>",
            sz_action_remove_from_friends: "<?php echo $LANG['action-remove-from-friends']; ?>",
            sz_action_cancel_friends_request: "<?php echo $LANG['action-cancel-friend-request']; ?>",
            sz_action_add_to_friends: "<?php echo $LANG['action-add-to-friends']; ?>",
            sz_message_prompt_like: "<?php echo $LANG['label-prompt-like']; ?>",
            sz_message_prompt_title: "<?php echo $LANG['page-prompt']; ?>",
            sz_message_empty_list: "<?php echo $LANG['label-empty-list']; ?>"
        };

    </script>

    <script type="text/javascript">

        var lang_prompt_box = "<?php echo $LANG['page-prompt']; ?>";
    </script>

    <script type="text/javascript" src="/js/my.js?x=2"></script>