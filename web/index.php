<?php
/**
 * Created by PhpStorm.
 * User: rboon
 * Date: 31-10-14
 * Time: 13:35
 */

//@todo create autoload for easy twitch api javascript and delete all api/v3 javascript files
//require("");

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<title></title>
		<link rel="stylesheet" type="text/css" href="css/site.css">
        <?php //@todo create autoload for easy twitch api javascript and delete all api/v3 javascript files ?>
		<script src="js/jquery-2.1.1.min.js"></script>
        <script src="js/config.js"></script>
		<script src="api/v3/twitch-api.js"></script>
        <script src="api/v3/twitch-app.js"></script>
        <script src="../module/chat/api/v1/api.js"></script>
        <script src="../module/chat/api/v1/app.js"></script>
		<script src="js/site.js"></script>
        <script src="js/site-test.js"></script>
        <script src="api/v3/twitch-app.js"></script>
	</head>
	<body>
		<div id="main">
            <div id="followers">
                <div class="headline">
                    <span>Recent followers</span>
                </div>
                <ul id="recentFollowers">
                </ul>
            </div>
            <div id="chat">
                <div class="headline">
                    <span>Chat</span>
                </div>
                <ul id="chatMessages">
                </ul>
            </div>
            <div id="mostRecentFollowerPopUp"></div>
            <div id="mostRecentSubscriberPopUp"></div>
		</div>
        <div id="test-menu">
            <div id="test-mostRecentFollowerPopUp">
                <input id="test-mostRecentFollowerPopUp-value" type="text" value="UsernameHere"><input id="test-mostRecentFollowerPopUp-button" type="button" value="Test most recent follower">
            </div>
            <div id="test-mostRecenSubscriberPopUp">
                <input id="test-mostRecentSubscriberPopUp-value" type="text" value="UsernameHere"><input id="test-mostRecentSubscriberPopUp-button" type="button" value="Test most recent subscriber">
            </div>
        </div>
	</body>
</html>
