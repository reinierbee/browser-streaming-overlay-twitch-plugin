/**
 * Created by rboon on 31-10-14.
 */


function ChatApi () {
    var config  = {};

    this.constructor = function () {
        config = {
            baseUrl: window.location.href.split('?')[0].replace("/web/index.php", "") + '/module/chat/api/v1/api.php',
            channel:'', // your channel name goes here
            sessionId: '',
            uriParam : {
                Accept:'application/json'
            }
        }
    };

    this.constructor();

    this.getConfig = function(){
        return config
    };

    this.setConfig = function(key,value){
        console.log("Setting config key: "+ key + " value: " + value)
        config[key] = value
    };

    this.setUriParam = function(key,value){
        config.uriParam[key] = value
    };
}

ChatApi.prototype.getMessages = function (callback,channel,id) {
    channel = this.getChannelName(channel);
    url = this.getConfig().baseUrl + '/messages/' + channel;
    if(id  !== undefined) {
        url = url + "/" + id;
    }
    url = url + this.getUriParams();
    this.restCall('GET',url,callback)
};

ChatApi.prototype.getMessagesNew = function (callback,channel) {
    channel = this.getChannelName(channel);
    url = this.getConfig().baseUrl + '/messages/new/' + channel + this.getUriParams();
    this.restCall('GET',url,callback)
};

ChatApi.prototype.restCall = function (type,url,callback) {
    console.log(url);
    $(document).ready(function() {
        $.ajax({
            url: url,
            type: type,
            contentType: 'application/json',
            dataType: 'json',
            success: function(response) { callback(response) },
            error: function(xhr, textStatus, errorThrown) { console.log("Failed to execute response: " + errorThrown) }
        });
    });
};

ChatApi.prototype.getChannelName = function (channel){
    return typeof channel !== 'undefined' ? channel : this.getConfig().channel;
};

TwitchApi.prototype.setUriParam = function (key,value){
    this.setUriParam(key,value);
};

/*
 * Stuff
 *
 */


ChatApi.prototype.urlParam = function(name){
    var results = new RegExp('[\?(&|#)]' + name + '=([^&#]*)').exec(window.location.href);
    if (results==null){
        return null;
    }
    else{
        return results[1] || 0;
    }
};

ChatApi.prototype.getUriParams = function(){
    return "";
    //return this.getAdditionalUriParamsUrl();
};


ChatApi.prototype.getAdditionalUriParamsUrl = function(){
    uriParam = '';
    $.each(this.getConfig().uriParam, function(key, value){
        uriParam += '&' + key + '=' + value
    });
    return uriParam;
};