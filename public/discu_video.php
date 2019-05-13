<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" const="text/html;charset=UTF-8" />
</head>
<body>
<script>

    function onVidyoClientLoaded(status){
        console.log("VidyoClient load state - " + status.state);
        if(status.state == "READY") {
            VC.CreateVidyoConnector({
                viewId:"renderer",
                viewStyle:"VIDYO_CONNECTORVIEWSTYLE_Default",
                remoteParticipants:16,
                logFileFilter:"error",
                logFileName:"",
                userData:""
            }).then(function (vc) {
                console.log("Create success");
                vidyoConnector = vc;
            }).catch(function(error){

            });
        }
    }

    function joinCall()
    {
        vidyoConnector.Connect({
            host:"prod.vidyo.io",
            token:"",
            displayName:"Mehdi",
            resourceId:"MeetiieRoom",
            onSuccess: function()
            {
                console.log("Connected !");
            },
            onFailure: function(reason)
            {
                console.error("Connection failed !");
            },
            onDisconnected: function(reason)
            {
                console.log("Disconnected - " + reason);
            }
        })
    }
</script>
    <script src="https://static.vidyo.io/latest/javascript/VidyoClient/VidyoClient.js?onload=onVidyoClientLoaded"></script>
    <button onclick="joinCall()">Connect</button>
    <div id="renderer"></div>
</body>
</html>
