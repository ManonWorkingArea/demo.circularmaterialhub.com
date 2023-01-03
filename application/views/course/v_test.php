
<!-- Player -->
<script type="text/javascript" src="/theme/interface/aduca/assets/js/jquery-3.4.1.min.js"></script>
<link href="/theme/interface/aduca/assets/player/start/content/global.css" rel='stylesheet' type='text/css'/>
<script type="text/javascript" src="/theme/interface/aduca/assets/player/start/java/FWDEVPlayer.js"></script>
<!-- Setup EVP -->
<script type="text/javascript">

    FWDEVPUtils.onReady(function()
    {
        FWDEVPlayer.videoStartBehaviour = "pause";
        new FWDEVPlayer(
        {
            //main settings
            instanceName:"mplayer",
            parentId:"avPlayer",
            mainFolderPath:"/theme/interface/aduca/assets/player/start/content",
            initializeOnlyWhenVisible:"no",
            skinPath:"minimal_skin_dark",
            displayType:"responsive",
            fillEntireVideoScreen:"no",
            playsinline:"yes",
            useWithoutVideoScreen:"no",
            autoScale:"yes",
            openDownloadLinkOnMobile:"no",
            useVectorIcons:"no",
            useResumeOnPlay:"no",
            goFullScreenOnButtonPlay:"no",
            useHEXColorsForSkin:"no",
            normalHEXButtonsColor:"#FF0000",
            privateVideoPassword:"428c841430ea18a70f7b06525d4b748a",
            startAtTime:"",
            stopAtTime:"",
            startAtVideoSource:1,
            videoSource:[{source:"https://vz-28af3134-886.b-cdn.net/24b5e108-1c7f-438d-8fde-8c49fa43a9c0/playlist.m3u8", label:"HD"}],
            posterPath:"https://vz-28af3134-886.b-cdn.net/24b5e108-1c7f-438d-8fde-8c49fa43a9c0/thumbnail.jpg",
            showErrorInfo:"yes",
            fillEntireScreenWithPoster:"yes",
            disableDoubleClickFullscreen:"no",
            addKeyboardSupport:"no",
            useChromeless:"no",
            showPreloader:"yes",
            preloaderColors:["#2e3092", "#ed1c24"],
            autoPlay:"no",
            autoPlayText:"Click to Unmute",
            loop:"no",
            scrubAtTimeAtFirstPlay:"00:00:00",
            maxWidth:1440,
            maxHeight:800,
            volume:100,
            greenScreenTolerance:200,
            backgroundColor:"#000000",
            posterBackgroundColor:"#000000",
            //lightbox settings
            closeLightBoxWhenPlayComplete:"no",
            lightBoxBackgroundOpacity:.6,
            lightBoxBackgroundColor:"#000000",
            //logo settings
            showLogo:"yes",
            hideLogoWithController:"yes",
            logoPosition:"bottomRight",
            logoLink:"<?php echo $GLOBALS["School"]['website'];?>",
            logoPath:"theme/interface/aduca/assets/player/player-logo.png",
            logoMargins:50,
            //controller settings
            showController:"yes",
            showDefaultControllerForVimeo:"no",
            showScrubberWhenControllerIsHidden:"yes",
            showControllerWhenVideoIsStopped:"yes",
            showVolumeScrubber:"yes",
            showVolumeButton:"yes",
            showTime:"yes",
            showRewindButton:"no",
            showQualityButton:"no",
            showShareButton:"no",
            showEmbedButton:"no",
            showDownloadButton:"no",
            showMainScrubberToolTipLabel:"yes",
            showChromecastButton:"no",
            showFullScreenButton:"yes",
            repeatBackground:"yes",
            controllerHeight:41,
            controllerHideDelay:3,
            startSpaceBetweenButtons:7,
            spaceBetweenButtons:9,
            mainScrubberOffestTop:14,
            scrubbersOffsetWidth:4,
            timeOffsetLeftWidth:5,
            timeOffsetRightWidth:3,
            volumeScrubberWidth:80,
            volumeScrubberOffsetRightWidth:0,
            timeColor:"#777777",
            youtubeQualityButtonNormalColor:"#777777",
            youtubeQualityButtonSelectedColor:"#FFFFFF",
            scrubbersToolTipLabelBackgroundColor:"#FFFFFF",
            scrubbersToolTipLabelFontColor:"#5a5a5a",
            //redirect at video end
            redirectURL:"",
            redirectTarget:"_self",
            //cuepoints
            executeCuepointsOnlyOnce:"no",
            cuepoints:[],
            //annotations
            annotiationsListId:"none",
            showAnnotationsPositionTool:"no",

            //audio visualizer
            audioVisualizerLinesColor:"#0099FF",
            audioVisualizerCircleColor:"#FFFFFF",
            //advertisement on pause window
            aopwTitle:"Advertisement",
            aopwSource:"",
            aopwWidth:400,
            aopwHeight:240,
            aopwBorderSize:6,
            aopwTitleColor:"#FFFFFF",
            //playback rate / speed
            showPlaybackRateButton:"yes",
            defaultPlaybackRate:"1", //0.25, 0.5, 1, 1.25, 1.5, 2
            //sticky on scroll
            stickyOnScroll:"yes",
            stickyOnScrollShowOpener:"yes",
            stickyOnScrollWidth:"450",
            stickyOnScrollHeight:"250",
            //sticky display settings
            showOpener:"yes",
            showOpenerPlayPauseButton:"yes",
            verticalPosition:"bottom",
            horizontalPosition:"center",
            showPlayerByDefault:"yes",
            animatePlayer:"yes",
            openerAlignment:"right",
            mainBackgroundImagePath:"/theme/aduca/assets/player/start/content/minimal_skin_dark/main-background.png",
            openerEqulizerOffsetTop:-1,
            openerEqulizerOffsetLeft:3,
            offsetX:0,
            offsetY:0,
            //embed window
            embedWindowCloseButtonMargins:15,
            borderColor:"#333333",
            mainLabelsColor:"#FFFFFF",
            secondaryLabelsColor:"#a1a1a1",
            shareAndEmbedTextColor:"#5a5a5a",
            inputBackgroundColor:"#000000",
            inputColor:"#FFFFFF",
            //ads
            openNewPageAtTheEndOfTheAds:"no",
            adsSource:[],
            adsButtonsPosition:"right",
            skipToVideoText:"You can skip to video in: ",
            skipToVideoButtonText:"Skip Ad",
            timeToHoldAds:4,
            adsTextNormalColor:"#999999",
            adsTextSelectedColor:"#FFFFFF",
            adsBorderNormalColor:"#666666",
            adsBorderSelectedColor:"#FFFFFF",
            //a to b loop
            useAToB:"no",
            atbTimeBackgroundColor:"transparent",
            atbTimeTextColorNormal:"#888888",
            atbTimeTextColorSelected:"#FFFFFF",
            atbButtonTextNormalColor:"#888888",
            atbButtonTextSelectedColor:"#FFFFFF",
            atbButtonBackgroundNormalColor:"#FFFFFF",
            atbButtonBackgroundSelectedColor:"#000000",
            //thumbnails preview
            thumbnailsPreview:"auto",
            thumbnailsPreviewWidth:196,
            thumbnailsPreviewHeight:110,
            thumbnailsPreviewBackgroundColor:"#000000",
            thumbnailsPreviewBorderColor:"#666",
            thumbnailsPreviewLabelBackgroundColor:"#666",
            thumbnailsPreviewLabelFontColor:"#FFF",
            // context menu
            contextMenuType:'none',
            showScriptDeveloper:"no",
            contextMenuBackgroundColor:"#1f1f1f",
            contextMenuBorderColor:"#1f1f1f",
            contextMenuSpacerColor:"#333",
            contextMenuItemNormalColor:"#888888",
            contextMenuItemSelectedColor:"#FFFFFF",
            contextMenuItemDisabledColor:"#444",
            //annotations
            annotiationsListId:"fwdAnnotations",
            showAnnotationsPositionTool:"no",
        });
        registerAPI();
    });

//Register API (an setInterval is required because the player is not available until the youtube API is loaded).
var timer = 0;
var count = 36000000
var registerAPIInterval;

function registerAPI()
{
    clearInterval(registerAPIInterval);
    if(window.mplayer)
    {
        mplayer.addListener(FWDEVPlayer.READY, readyHandler);
        mplayer.addListener(FWDEVPlayer.PLAY, playHandler);
        mplayer.addListener(FWDEVPlayer.PAUSE, pauseHandler);
        mplayer.addListener(FWDEVPlayer.STOP, stopHandler);
    }
    else
    {
        registerAPIInterval = setInterval(registerAPI, 100);
    }
};

    //API event listeners examples
function readyHandler(e)
{
    console.log("API -- ready to use");
}

function playHandler(e)
{
    console.log("API -- play");
}

function pauseHandler(e)
{
    console.log("API -- pause");
}

function stopHandler(e)
{
    console.log("API -- stop");
}

function updateVideoSourceHandler(e)
{
    console.log("API -- video source update: " + mplayer.getVideoSource());
}

function updatePosterSourceHandler(e)
{
    console.log("API -- video source update: " + mplayer.getPosterSource());
}

//API methods examples
function play()
{
    mplayer.play();
}

function pause()
{
    mplayer.pause();
}

function stop()
{
    mplayer.stop();
}

function scrub(percent)
{
    mplayer.scrub(percent);
}

function setVolume(percent)
{
    mplayer.setVolume(percent);
}

function goFullScreen()
{
    mplayer.goFullScreen();
}

function getCurrentTimer(e)
{
    return e.currentTime;
    console.log("API -- stop");
}

function updateTimeHandler(e)
{
    console.log("API -- update time: " + e.currentTime + "/" + e.totalTime);
}

</script>

<div id="avPlayer"></div>