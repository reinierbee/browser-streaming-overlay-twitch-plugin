/**
 * Created by rboon on 31-10-14.
 */


function ChatApi () {
    var config  = {};

    this.constructor = function () {
        config = {
            target:'', // your channel name goes here
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
//channels
ChatApi.prototype.getChannels = function (callback,channel) {
    channel = this.getChannelName(channel);
    url = this.getConfig().baseUrl + '/channels/' + channel + this.getUriParams();
    this.restCall('GET',url,callback)
};

ChatApi.prototype.restCall = function (type,url,callback) {
    console.log(url);
    $(document).ready(function() {
        $.ajax({
            url: url,
            type: type,
            contentType: 'application/json',
            dataType: 'jsonp',
            success: function(response) { callback(response) },
            error: function() { console.log("Failed to execute " + arguments.callee.name) }
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
 * Authenticate
 *
 */

TwitchApi.prototype.getAuth = function () {
    return '?oauth_token=' + this.getConfig().token
};

TwitchApi.prototype.appLoginRedirect = function (){
    console.log("Redirecting to twitch auth screen");
    window.location.replace(this.getConfig().baseUrl + '/oauth2/authorize?response_type=token&client_id='+this.getConfig().clientId+'&redirect_uri='+this.getConfig().redirectUrl+'&scope='+this.getConfig().scope);
};

TwitchApi.prototype.urlParam = function(name){
    var results = new RegExp('[\?(&|#)]' + name + '=([^&#]*)').exec(window.location.href);
    if (results==null){
        return null;
    }
    else{
        return results[1] || 0;
    }
};

TwitchApi.prototype.getUriParams = function(){
    return this.getAuth() + this.getAdditionalUriParamsUrl()
};

TwitchApi.prototype.getAdditionalUriParamsUrl = function(){
    uriParam = '';
    $.each(this.getConfig().uriParam, function(key, value){
        uriParam += '&' + key + '=' + value
    });
    return uriParam;
};