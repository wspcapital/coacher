﻿/*
* Copyright (C) 2012-2016 Doubango Telecom <http://www.doubango.org>
* License: BSD
* This file is part of Open Source sipML5 solution <http://www.sipml5.org>
*/

function tsk_api_add_js_script(s_elt) {
    var tag_hdr = document.getElementsByTagName(s_elt)[0];
    for (var i = 1; i < arguments.length; ++i) {
        var tag_script = document.createElement('script');
        tag_script.setAttribute('type', 'text/javascript');
        tag_script.setAttribute('src', "/" + arguments[i] + "?svn=241");
        tag_hdr.appendChild(tag_script);
    }
};

tsk_api_add_js_script('head',
    'assets/dist/libs/webrtc/src/adapter.js',

    'assets/dist/libs/webrtc/src/tinySAK/src/tsk_base64.js',
    'assets/dist/libs/webrtc/src/tinySAK/src/tsk_buff.js',
    'assets/dist/libs/webrtc/src/tinySAK/src/tsk_fsm.js',
    'assets/dist/libs/webrtc/src/tinySAK/src/tsk_md5.js',
    'assets/dist/libs/webrtc/src/tinySAK/src/tsk_param.js',
    'assets/dist/libs/webrtc/src/tinySAK/src/tsk_ragel.js',
    'assets/dist/libs/webrtc/src/tinySAK/src/tsk_string.js',
    'assets/dist/libs/webrtc/src/tinySAK/src/tsk_utils.js'
);