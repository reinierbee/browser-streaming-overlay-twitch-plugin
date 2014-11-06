/*
 * Copyright (c) 2014. Reinier Boon (ssjkrillen@hotmail.com)
 *
 * License
 * ----
 * Attribution-NonCommercial 3.0 Unported
 * https://creativecommons.org/licenses/by-nc/3.0/
 */

function ChatApp () {

    var chat = new ChatApi();
    var app = this;
    var config  = {};

    this.constructor = function () {
        config = {
            chat : {
                loaded:false,
                callback:'',
                pollTime:500
            }
        };
        chat.setConfig("channel",myConfig.channel);
    };

    this.constructor();

    this.setConfig = function(key,value){
        if(value !== null && typeof value === 'object') {
            for(x in value) {
                console.log("Setting config: ["+ key + "]["+ x +"] value: " + value[x])
                config[key][x] = value[x]
            }
        } else {
            console.log("Setting config: ["+ key + "] = " + value)
            config[key] = value
        }
    };

    /*
     *  Subscriber stuff
     */

    this.chatAction = function (message,callback) {
        config.chat.lastMessageId = message[0].id;
        callback(message)
    };

    this.pollChat = function () {
        setTimeout(function() {
            app.getNewMessages();
            app.pollChat();
        }, config.chat.pollTime);
    };


    this.getNewMessages = function () {
        chat.getMessagesNew(app.addMessages,config.channel);
        config.chat.loaded = true;
    };


    this.addMessages = function (message) {
        if(message.length !== 0) {
            console.log(message);
            if(config.chat.loaded == true && config.chat.callback !== ''){
                app.chatAction(message,config.chat.callback)
            }
        } else {
            console.log('No new messages');
        }
    };
/*
    this.getNewMessages = function () {
        newFollowList.follows = newFollowList.follows.reverse()
        for (key in newFollowList.follows) {
            entry = newFollowList.follows[key]
            if(followers.length === 0) {
                console.log("First entry _id: " + entry.user._id);
                app.addNewFollower(entry)
            } else if(!app.followerInList(entry.user._id)){
                console.log("New entry _id: " + newFollowList.follows[key].user._id);
                app.addNewFollower(entry)
            } else {
                //console.log("Excisting entry _id: " + entry.user._id);
            }
        }
        config.follower.loaded = true;
    };
*/
    this.getRecentFollowers = function () {
        return followers;
    };
}