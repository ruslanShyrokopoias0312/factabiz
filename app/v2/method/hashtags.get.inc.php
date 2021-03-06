<?php

/*!
 * ifsoft.co.uk
 *
 * http://ifsoft.com.ua, http://ifsoft.co.uk
 * raccoonsquare@gmail.com
 *
 * Copyright 2012-2015 Demyanchuk Dmitry (raccoonsquare@gmail.com)
 */

if (!empty($_POST)) {

    $accountId = isset($_POST['accountId']) ? $_POST['accountId'] : 0;
    $accessToken = isset($_POST['accessToken']) ? $_POST['accessToken'] : '';

    $language = isset($_POST['language']) ? $_POST['language'] : 'en';
    $hashtag = isset($_POST['hashtag']) ? $_POST['hashtag'] : '';
    $itemId = isset($_POST['itemId']) ? $_POST['itemId'] : 0;

    $language = helper::clearText($language);
    $language = helper::escapeText($language);

    $hashtag = helper::clearText($hashtag);
    $hashtag = helper::escapeText($hashtag);

    $itemId = helper::clearInt($itemId);

    $result = array("error" => true,
                    "error_code" => ERROR_UNKNOWN);

    $auth = new auth($dbo);

    if (!$auth->authorize($accountId, $accessToken)) {

        api::printError(ERROR_ACCESS_TOKEN, "Error authorization.");
    }

    $hashtags = new hashtag($dbo);
    $hashtags->setRequestFrom($accountId);
//    $hashtags->setLanguage($LANG['lang-code']);

    $result = $hashtags->search($hashtag, $itemId);

    echo json_encode($result);
    exit;
}
