$(function () {



    var cbVideoDisable = {checked: ""};
    var cbAVPFDisable;
    var txtWebsocketServerUrl = {value: ' '};
    var txtSIPOutboundProxyUrl = {value: ""};
    var txtInfo;
    var cbRTCWebBreaker = {checked: ""};
    var txtIceServers = {value: ""};
    var txtBandwidth = {value: ""};
    var txtSizeVideo = {value: ""};
    var cbEarlyIMS = { checked: ""};
    var cbDebugMessages = {checked: ""};
    var cbCacheMediaStream = {checked: ""};
    var cbCallButtonOptions = {checked: ""};



    cbVideoDisable.checked = document.getElementById("cbVideoDisable");
    cbRTCWebBreaker.checked = document.getElementById("cbRTCWebBreaker");
    txtWebsocketServerUrl.value = 'wss://ipv4.in-staging.pub:8089/ws';
    txtSIPOutboundProxyUrl.value = document.getElementById("txtSIPOutboundProxyUrl");
    txtInfo = document.getElementById("txtInfo");
    txtIceServers.value = "[{ url: 'stun:stun.l.google.com:19302'}]";
    //txtWebsocketServerUrl.disabled = !window.WebSocket || navigator.appName == "Microsoft Internet Explorer"; // Do not use WS on IE
   /// document.getElementById("").disabled = !window.localStorage;
   // document.getElementById("btnRevert").disabled = !window.localStorage;

    if (window.localStorage) {
        settingsRevert(true);
    }

    settingsSave();

    function settingsSave() {
        window.localStorage.setItem('org.doubango.expert.disable_video', "false");
        window.localStorage.setItem('org.doubango.expert.enable_rtcweb_breaker', "false");
        if (!txtWebsocketServerUrl.disabled) {
            window.localStorage.setItem('org.doubango.expert.websocket_server_url', 'wss://ipv4.in-staging.pub:8089/ws');
        }
        window.localStorage.setItem('org.doubango.expert.sip_outboundproxy_url', 'wss://ipv4.in-staging.pub:8089/ws');
        window.localStorage.setItem('org.doubango.expert.ice_servers', txtIceServers.value);
        window.localStorage.setItem('org.doubango.expert.bandwidth', txtBandwidth.value);
        window.localStorage.setItem('org.doubango.expert.video_size', txtSizeVideo.value);
        window.localStorage.setItem('org.doubango.expert.disable_early_ims', "false");
        window.localStorage.setItem('org.doubango.expert.disable_debug', "false");
        window.localStorage.setItem('org.doubango.expert.enable_media_caching', "false");
        window.localStorage.setItem('org.doubango.expert.disable_callbtn_options', "false");

       /* txtInfo.innerHTML = '<i>Saved</i>';*/
    }

    function settingsRevert(bNotUserAction) {
        cbVideoDisable.checked = (window.localStorage.getItem('org.doubango.expert.disable_video') == "true");
        cbRTCWebBreaker.checked = (window.localStorage.getItem('org.doubango.expert.enable_rtcweb_breaker') == "true");
        txtWebsocketServerUrl.value = (window.localStorage.getItem('org.doubango.expert.websocket_server_url') || "");
        txtSIPOutboundProxyUrl.value = (window.localStorage.getItem('org.doubango.expert.sip_outboundproxy_url') || "");
        txtIceServers.value = (window.localStorage.getItem('org.doubango.expert.ice_servers') || "");
        txtBandwidth.value = (window.localStorage.getItem('org.doubango.expert.bandwidth') || "");
        txtSizeVideo.value = (window.localStorage.getItem('org.doubango.expert.video_size') || "");
        cbEarlyIMS.checked = (window.localStorage.getItem('org.doubango.expert.disable_early_ims') == "true");
        cbDebugMessages.checked = (window.localStorage.getItem('org.doubango.expert.disable_debug') == "true");
        cbCacheMediaStream.checked = (window.localStorage.getItem('org.doubango.expert.enable_media_caching') == "true");
        cbCallButtonOptions.checked = (window.localStorage.getItem('org.doubango.expert.disable_callbtn_options') == "true");


       /* if (!bNotUserAction) {
            txtInfo.innerHTML = '<i>Reverted</i>';
        }*/
    }
});
