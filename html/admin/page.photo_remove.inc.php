<?php

    /*!
     * ifsoft.co.uk
     *
     * http://ifsoft.com.ua, http://ifsoft.co.uk
     * raccoonsquare@gmail.com
     *
     * Copyright 2012-2019 Demyanchuk Dmitry (raccoonsquare@gmail.com)
     */

    if (!admin::isSession()) {

        header("Location: /admin/login");
        exit;
    }

    $stats = new stats($dbo);
    $admin = new admin($dbo);

    $photoId = 0;
    $photoInfo = array();

    if (isset($_GET['id'])) {

        $photoId = isset($_GET['id']) ? $_GET['id'] : 0;
        $accessToken = isset($_GET['access_token']) ? $_GET['access_token'] : '';
        $fromUserId = isset($_GET['fromUserId']) ? $_GET['fromUserId'] : 0;

        $photoId = helper::clearInt($photoId);
        $fromUserId = helper::clearInt($fromUserId);

        if (!APP_DEMO) {

            $gallery = new gallery($dbo);
            $gallery->setRequestFrom($fromUserId);

            $gallery->remove($photoId);
        }

    } else {

        header("Location: /admin/main");
        exit;
    }
