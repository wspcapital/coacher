﻿/*
* Copyright (C) 2012-2016 Doubango Telecom <http://www.doubango.org>
* License: BSD
* This file is part of Open Source sipML5 solution <http://www.sipml5.org>
*/
function tsip_api_add_js_scripts(s_elt) {
    var tag_hdr = document.getElementsByTagName(s_elt)[0];
    for (var i = 1; i < arguments.length; ++i) {
        var tag_script = document.createElement('script');
        tag_script.setAttribute('type', 'text/javascript');
        tag_script.setAttribute('src', "/" + arguments[i] + "?svn=241");
        tag_hdr.appendChild(tag_script);
    }
};

// add tinySAK API
tsip_api_add_js_scripts('head', 'assets/dist/libs/webrtc/src/tinySAK/src/tsk_api.js');

// add tinyMEDIA API
tsip_api_add_js_scripts('head', 'assets/dist/libs/webrtc/src/tinyMEDIA/src/tmedia_api.js');

// add tinySDP API
tsip_api_add_js_scripts('head', 'assets/dist/libs/webrtc/src/tinySDP/src/tsdp_api.js');

// add tinySIP API
tsip_api_add_js_scripts('head',
'assets/dist/libs/webrtc/src/tinySIP/src/tsip_action.js',
'assets/dist/libs/webrtc/src/tinySIP/src/tsip_event.js',
'assets/dist/libs/webrtc/src/tinySIP/src/tsip_message.js',
'assets/dist/libs/webrtc/src/tinySIP/src/tsip_session.js',
'assets/dist/libs/webrtc/src/tinySIP/src/tsip_stack.js',
'assets/dist/libs/webrtc/src/tinySIP/src/tsip_timers.js',
'assets/dist/libs/webrtc/src/tinySIP/src/tsip_uri.js'
);

tsip_api_add_js_scripts('head'
// 'assets/dist/libs/webrtc/src/tinySIP/src/api/tsip_api_common.js', #include_in<tsip_session.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/api/tsip_api_info.js', #include_in<tsip_session.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/api/tsip_api_invite.js', #include_in<tsip_session.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/api/tsip_api_message.js', #include_in<tsip_session.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/api/tsip_api_options.js', #include_in<tsip_session.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/api/tsip_api_publish.js', #include_in<tsip_session.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/api/tsip_api_register.js', #include_in<tsip_session.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/api/tsip_api_subscribe.js' #include_in<tsip_session.js>
);

tsip_api_add_js_scripts('head',
'assets/dist/libs/webrtc/src/tinySIP/src/authentication/tsip_auth.js',
'assets/dist/libs/webrtc/src/tinySIP/src/authentication/tsip_challenge.js'
);

tsip_api_add_js_scripts('head', 
'assets/dist/libs/webrtc/src/tinySIP/src/dialogs/tsip_dialog.js',
// 'assets/dist/libs/webrtc/src/tinySIP/src/dialogs/tsip_dialog_generic.js', #include_in<tsip_dialog.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/dialogs/tsip_dialog_generic__message.js', #include_in<tsip_dialog_generic.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/dialogs/tsip_dialog_invite.js', #include_in<tsip_dialog.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/dialogs/tsip_dialog_invite__client.js', #include_in<tsip_dialog_invite.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/dialogs/tsip_dialog_invite__ect.js', #include_in<tsip_dialog_invite.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/dialogs/tsip_dialog_invite__hold.js', #include_in<tsip_dialog_invite.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/dialogs/tsip_dialog_invite__server.js', #include_in<tsip_dialog_invite.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/dialogs/tsip_dialog_invite__timers.js' #include_in<tsip_dialog_invite.js>
'assets/dist/libs/webrtc/src/tinySIP/src/dialogs/tsip_dialog_layer.js'
// 'assets/dist/libs/webrtc/src/tinySIP/src/dialogs/tsip_dialog_publish.js', #include_in<tsip_dialog.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/dialogs/tsip_dialog_register.js', #include_in<tsip_dialog.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/dialogs/tsip_dialog_subscribe.js' #include_in<tsip_dialog.js>
);

tsip_api_add_js_scripts('head',
'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header.js'
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_Allow.js', #see<tsip_header_StrArray>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_Allow_Events.js', #see<tsip_header_StrArray>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_Authorization.js', #include<tsip_header.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_Call_ID.js', #see<tsip_header_Str.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_Contact.js', #include<tsip_header.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_Content_Length.js', #see<tsip_header_Int.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_Content_Type.js', #include<tsip_header.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_CSeq.js', #include<tsip_header.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_Date.js', #include<tsip_header.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_Dummy.js', #include<tsip_header.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_Event.js', #see<tsip_header_Str.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_Expires.js', #see<tsip_header_Int.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_From.js', #see<tsip_header_NameAddr>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_Int.js', #include <tsip_header.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_Max_Forwards.js', #see<tsip_header_Int.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_Min_Expires.js', #see<tsip_header_Int.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_Min_SE.js', #see<tsip_header_Int.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_P_Access_Network_Info.js', #see<tsip_header_Str.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_P_Asserted_Identity.js', #see<tsip_header_NameAddrArray.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_P_Associated_URI.js', #see<tsip_header_NameAddrArray.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_P_Charging_Function_Addresses.js', #include<tsip_header.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_P_Preferred_Identity.js', #include<tsip_header.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_Path.js', #see<tsip_header_NameAddrArray.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_Privacy.js', #see<tsip_header_StrArray>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_RAck.js', #include<tsip_header.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_Record_Route.js', #see<tsip_header_NameAddrArray.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_Refer_Sub.js', #include<tsip_header.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_Refer_To.js', #see<tsip_header_NameAddr>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_Referred_By.js', #see<tsip_header_NameAddr>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_Require.js', #see<tsip_header_StrArray>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_Route.js', #see<tsip_header_NameAddrArray.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_RSeq.js', // #see<tsip_header_Int.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_Server.js', #see<tsip_header_Str.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_Service_Route.js', #see<tsip_header_NameAddrArray.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_Session_Expires.js', #include<tsip_header.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_SIP_ETag.js', #see<tsip_header_Str.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_SIP_If_Match.js', #see<tsip_header_Str.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_Str.js', #include <tsip_header.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_Subscription_State.js', #include<tsip_header.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_Supported.js', #see<tsip_header_StrArray>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_To.js', #see<tsip_header_NameAddr>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_User_Agent.js', #see<tsip_header_Str.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_Via.js', #include<tsip_header.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_Warning.js', #include<tsip_header.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/headers/tsip_header_WWW_Authenticate.js' #include<tsip_header.js>
);

tsip_api_add_js_scripts('head',
'assets/dist/libs/webrtc/src/tinySIP/src/parsers/tsip_parser_header.js'
// 'assets/dist/libs/webrtc/src/tinySIP/src/parsers/tsip_parser_message.js', #include_in<tsip_message.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/parsers/tsip_parser_uri.js' #include_in<tsip_uri.js>
);

tsip_api_add_js_scripts('head',
'assets/dist/libs/webrtc/src/tinySIP/src/transactions/tsip_transac.js'
// 'assets/dist/libs/webrtc/src/tinySIP/src/transactions/tsip_transac_ict.js', #include_in<tsip_transac.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/transactions/tsip_transac_ist.js', #include_in<tsip_transac.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/transactions/tsip_transac_layer.js', #include_in<tsip_transac.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/transactions/tsip_transac_nict.js', #include_in<tsip_transac.js>
// 'assets/dist/libs/webrtc/src/tinySIP/src/transactions/tsip_transac_nist.js' #include_in<tsip_transac.js>
);

tsip_api_add_js_scripts('head',
'assets/dist/libs/webrtc/src/tinySIP/src/transports/tsip_transport.js',
'assets/dist/libs/webrtc/src/tinySIP/src/transports/tsip_transport_layer.js'
);