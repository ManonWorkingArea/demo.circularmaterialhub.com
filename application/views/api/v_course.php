<link rel="stylesheet" type="text/css"  href="/theme/demo/assets/core/player/js/plugin/ultimateplayer/start/content/global.css"/>
<script type="text/javascript" src="/theme/demo/assets/core/player/js/plugin/ultimateplayer/start/java/FWDUVPlayer.js"></script>

<script type="text/javascript">

	//FWDConsole.setPrototype();
	//var logger =  new FWDConsole();

	FWDUVPUtils.onReady(function(){

		new FWDUVPlayer({
			//main settings
			useYoutube:"yes",
			useVimeo:"no",
			instanceName:"player1",
			parentId:"avplayer",
			playlistsId:"playlists",
			mainFolderPath:"/theme/demo/assets/core/player/js/plugin/ultimateplayer/start/content",
			skinPath:"minimal_skin_dark",
			displayType:"responsive",
			fillEntireVideoScreen:"yes",
			useHEXColorsForSkin:"yes",
			normalHEXButtonsColor:"#FF0000",
			selectedHEXButtonsColor:"#00FF00",
			fillEntireVideoScreen:"no",
			useHEXColorsForSkin:"no",
			normalHEXButtonsColor:"#FF0000",
			selectedHEXButtonsColor:"#000000",
			useDeepLinking:"no",
			rightClickContextMenu:"default",
			addKeyboardSupport:"no",
			autoScale:"yes",
			showButtonsToolTip:"yes",
			stopVideoWhenPlayComplete:"no",
			autoPlay:"yes",
			loop:"no",
			shuffle:"no",
			maxHeight:550,
			maxWidth:980,
			buttonsToolTipHideDelay:1.5,
			volume:0,
			backgroundColor:"#000000",
			videoBackgroundColor:"#000000",
			posterBackgroundColor:"#000000",
			buttonsToolTipFontColor:"#5a5a5a",
			//logo settings
			showLogo:"yes",
			hideLogoWithController:"yes",
			logoPosition:"topRight",
			logoLink:"https://academy.ecobz.training/",
			logoPath:"https://cdn.ecobz.training/img.php?file=CDN1/academy/graphic/player-logo.png&wt=false",
			logoMargins:5,
			//playlists/categories settings
			showPlaylistsButtonAndPlaylists:"no",
			showPlaylistsByDefault:"no",
			thumbnailSelectedType:"opacity",
			startAtPlaylist:0,
			buttonsMargins:0,
			thumbnailMaxWidth:350,
			thumbnailMaxHeight:350,
			horizontalSpaceBetweenThumbnails:8,
			verticalSpaceBetweenThumbnails:8,
			//playlist settings
			showPlaylistButtonAndPlaylist:"no",
			playlistPosition:"right",
			showPlaylistByDefault:"no",
			showPlaylistName:"yes",
			showSearchInput:"yes",
			showLoopButton:"yes",
			showShuffleButton:"yes",
			showNextAndPrevButtons:"yes",
			forceDisableDownloadButtonForFolder:"yes",
			addMouseWheelSupport:"yes",
			startAtRandomVideo:"no",
			folderVideoLabel:"VIDEO ",
			playlistRightWidth:310,
			playlistBottomHeight:599,
			startAtVideo:0,
			maxPlaylistItems:50,
			thumbnailWidth:70,
			thumbnailHeight:70,
			spaceBetweenControllerAndPlaylist:2,
			spaceBetweenThumbnails:2,
			scrollbarOffestWidth:8,
			scollbarSpeedSensitivity:.5,
			playlistBackgroundColor:"#000000",
			playlistNameColor:"#FFFFFF",
			thumbnailNormalBackgroundColor:"#1b1b1b",
			thumbnailHoverBackgroundColor:"#313131",
			thumbnailDisabledBackgroundColor:"#272727",
			searchInputBackgroundColor:"#000000",
			searchInputColor:"#999999",
			youtubeAndFolderVideoTitleColor:"#FFFFFF",
			youtubeOwnerColor:"#999999",
			youtubeDescriptionColor:"#999999",
			//controller settings
			showController:"yes",
			showControllerWhenVideoIsStopped:"yes",
			showNextAndPrevButtonsInController:"no",
			showVolumeButton:"yes",
			showTime:"yes",
			showQualityButton:"yes",
			showSubtitleButton:"yes",
			showInfoButton:"no",
			showDownloadButton:"no",
			showShareButton:"no",
			showEmbedButton:"no",
			showFullScreenButton:"yes",
			disableVideoScrubber:"no",
			repeatBackground:"yes",
			controllerHeight:37,
			controllerHideDelay:3,
			startSpaceBetweenButtons:7,
			spaceBetweenButtons:8,
			scrubbersOffsetWidth:2,
			mainScrubberOffestTop:14,
			timeOffsetLeftWidth:5,
			timeOffsetRightWidth:3,
			timeOffsetTop:0,
			volumeScrubberHeight:80,
			volumeScrubberOfsetHeight:12,
			timeColor:"#888888",
			youtubeQualityButtonNormalColor:"#888888",
			youtubeQualityButtonSelectedColor:"#FFFFFF",
			//subtitle
			showSubtitileByDefault:"yes",
			subtitlesOffLabel:"Subtitle off",
			//popup add windows
			showPopupAdsCloseButton:"yes",
			//embed window and info window
			embedAndInfoWindowCloseButtonMargins:0,
			borderColor:"#333333",
			mainLabelsColor:"#FFFFFF",
			secondaryLabelsColor:"#a1a1a1",
			shareAndEmbedTextColor:"#5a5a5a",
			inputBackgroundColor:"#000000",
			inputColor:"#FFFFFF",
			//annotations
			showAnnotationsPositionTool:"no",
			//ads
			openNewPageAtTheEndOfTheAds:"no",
			playAdsOnlyOnce:"no",
			adsButtonsPosition:"left",
			skipToVideoText:"คุณจะสามารถข้ามโฆษณาได้ใน : ",
			skipToVideoButtonText:"ข้ามโฆษณานี้",
			adsTextNormalColor:"#888888",
			adsTextSelectedColor:"#FFFFFF",
			adsBorderNormalColor:"#666666",
			adsBorderSelectedColor:"#FFFFFF"
		});
	});


</script>

<style>

#code-block {
    background-color: #eee;
    border: 1px solid #999;
    display: block;
    padding: 20px;
    width: 50%;
    margin-left: auto;
    margin-right: auto;
    overflow-x: auto;
    white-space: nowrap;
}

#profilePictureDiv {
    text-align: center;
}

#profileImageDiv {
    height: 100px;
    width: 100px;
}

#statusMessage {
    position: relative;
    top: 40px;
}

.textLeft {
    text-align: left;
}

.buttonGroup {
    padding-top: 20px;
}

.hidden {
    display: none;
}
</style>

<!-- channel -->

<div class="channel">

    <div class="channel-user">

      <div id="avplayer"></div>
      <ul id="playlists" style="display:none;">
        <li data-source="playlist1" data-playlist-name="MY HTML PLAYLIST 1" data-thumbnail-path="content/thumbnails/large1.jpg"></li>
      </ul>
      <ul id="playlist1" style="display:none;">
        <li data-thumb-source="https://cdn.ecobz.training/img.php?file=<?php echo $data["Lesson"]['lesson_cover'];?>"  data-video-source="[{source:'https://www.youtube.com/watch?v=ob78clAs3uM', label:'small version'}]"  data-start-at-video="0"  data-start-at-video="0"  data-poster-source="https://cdn.ecobz.training/img.php?file=<?php echo $data["Lesson"]['lesson_cover'];?>"   data-subtitle-soruce="[{source:'https://www.me-rean.com/course/action/subtitle.txt', label:'คำอธิบาย'}]"   data-start-at-subtitle="0"  data-downloadable="no"  data-scrub-at-time-at-first-play="none"></li>
      </ul>

    </div>

</div>
<!-- end channel -->

<div class="video-single segments-page">
  <div class="container">

      <div class="content-text">
          <div class="video-title">
              <h5>How Envato Uses New Relic Insights</h5>
              <p>22 views
                  <span>2 comments</span>
              </p>
          </div>
      </div>

  </div>
</div>

<div class="channel channel-content">

    <div class="container">
        <div class="segments">

            <div class="content-head">
                <div class="row">

                    <div class="col s12">
                      <?php

                      //echo "Data Callback : </br>";
                      print_r($data["callback"]);
                      //echo "</br>";
                      print_r($data["Lesson"]);

                      ?>
                    </div>

                    <div class="col s6">
                        <div class="section-title">
                            <h3>Video</h3>
                        </div>
                    </div>
                    <div class="col s6">
                        <div class="sort">
                            <a class="dropdown-button" href="" data-activates="dropdown">Sort by
                                <i class="fa fa-sort"></i>
                            </a>
                            <ul id="dropdown" class="dropdown-content">
                                <li>
                                    <a href="">Newest</a>
                                </li>
                                <li>
                                    <a href="">Date</a>
                                </li>
                                <li>
                                    <a href="">Views</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s6">
                    <div class="image">
                        <a href="">
                            <img src="/theme/external/images/post4.jpg" alt="">
                            <div class="time">04:11</div>
                        </a>
                    </div>
                </div>
                <div class="col s6">
                    <div class="text">
                        <a href="">
                            <h5>10 Skills of a professional chef</h5>
                        </a>
                        <p class="date">10 minute ago</p>
                        <p>22 views</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s6">
                    <div class="image">
                        <a href="">
                            <img src="/theme/external/images/post12.jpg" alt="">
                            <div class="time">04:11</div>
                        </a>
                    </div>
                </div>
                <div class="col s6">
                    <div class="text">
                        <a href="">
                            <h5>The enthusiasm of cycling participants</h5>
                        </a>
                        <p class="date">10 minute ago</p>
                        <p>22 views</p>
                    </div>
                </div>
            </div>
            <!-- <div class="row">
                <div class="col s6">
                    <div class="image">
                        <a href="">
                            <img src="/theme/external/images/post8.jpg" alt="">
                            <div class="time">04:11</div>
                        </a>
                    </div>
                </div>
                <div class="col s6">
                    <div class="text">
                        <a href="">
                            <h5>Top 10 Skill football highlights</h5>
                        </a>
                        <p class="date">10 minute ago</p>
                        <p>22 views</p>
                    </div>
                </div>
            </div> -->
            <!-- <div class="row">
                <div class="col s6">
                    <div class="image">
                        <a href="">
                            <img src="/theme/external/images/post9.jpg" alt="">
                            <div class="time">04:11</div>
                        </a>
                    </div>
                </div>
                <div class="col s6">
                    <div class="text">
                        <a href="">
                            <h5>Top 10 Skill Football</h5>
                        </a>
                        <p class="date">10 minute ago</p>
                        <p>22 views</p>
                    </div>
                </div>
            </div> -->
            <!-- <div class="row">
                <div class="col s6">
                    <div class="image">
                        <a href="">
                            <img src="/theme/external/images/post1.jpg" alt="">
                            <div class="time">04:11</div>
                        </a>
                    </div>
                </div>
                <div class="col s6">
                    <div class="text">
                        <a href="">
                            <h5>Top 5 Trending fashion in 2018</h5>
                        </a>
                        <p class="date">10 minute ago</p>
                        <p>22 views</p>
                    </div>
                </div>
            </div> -->
            <!-- <div class="pagination">
                <ul>
                    <li class="disabled">
                        <a href="">1</a>
                    </li>
                    <li>
                        <a href="">2</a>
                    </li>
                    <li>
                        <a href="">3</a>
                    </li>
                    <li>
                        <a href="">4</a>
                    </li>
                    <li>
                        <a href="">5</a>
                    </li>
                </ul>
            </div> -->
        </div>
    </div>
</div>
<!-- end channel -->


<!-- <div id="liffAppContent">

    <div class="buttonGroup">
        <div class="buttonRow">
            <button id="openWindowButton">Open External Window</button>
            <button id="closeWindowButton">Close LIFF App</button>
        </div>
        <div class="buttonRow">
            <button id="scanQrCodeButton">Open QR Code Reader</button>
            <button id="sendMessageButton">Send Message</button>
        </div>
        <div class="buttonRow">
            <button id="getAccessToken">Get Access Token</button>
            <button id="getProfileButton">Get Profile</button>
        </div>
        <div class="buttonRow">
            <button id="shareTargetPicker">Open Share Target Picker</button>
        </div>
    </div>
    <div id="shareTargetPickerMessage"></div>

    <div id="accessTokenData" class="hidden textLeft">
        <h2>Access Token</h2>
        <a href="#" onclick="toggleAccessToken()">Close Access Token</a>
        <table>
            <tr>
                <th>accessToken</th>
                <td id="accessTokenField"></td>
            </tr>
        </table>
    </div>

    <div id="scanQr" class="hidden textLeft">
        <h2>QR Code reader</h2>
        <a href="#" onclick="toggleQrCodeReader()">Close QR Code Reader Result</a>
        <table>
            <tr>
                <th>scanCode Result</th>
                <td id="scanQrField"></td>
            </tr>
        </table>
    </div>

    <div id="profileInfo" class="hidden textLeft">
        <h2>Profile</h2>
        <a href="#" onclick="toggleProfileData()">Close Profile</a>
        <div id="profilePictureDiv">
        </div>
        <table>
            <tr>
                <th>userId</th>
                <td id="userIdProfileField"></td>
            </tr>
            <tr>
                <th>displayName</th>
                <td id="displayNameField"></td>
            </tr>
            <tr>
                <th>statusMessage</th>
                <td id="statusMessageField"></td>
            </tr>
        </table>
    </div>

    <div id="liffData">
        <h2 id="liffDataHeader" class="textLeft">LIFF Data</h2>
        <table>
            <tr>
                <th>OS</th>
                <td id="deviceOS" class="textLeft"></td>
            </tr>
            <tr>
                <th>Language</th>
                <td id="browserLanguage" class="textLeft"></td>
            </tr>
            <tr>
                <th>LIFF SDK Version</th>
                <td id="sdkVersion" class="textLeft"></td>
            </tr>
            <tr>
                <th>LINE Version</th>
                <td id="lineVersion" class="textLeft"></td>
            </tr>
            <tr>
                <th>isInClient</th>
                <td id="isInClient" class="textLeft"></td>
            </tr>
            <tr>
                <th>isLoggedIn</th>
                <td id="isLoggedIn" class="textLeft"></td>
            </tr>
        </table>
    </div>

    <div class="buttonGroup">
        <button id="liffLoginButton">Log in</button>
        <button id="liffLogoutButton">Log out</button>
    </div>
    <div id="statusMessage">
        <div id="isInClientMessage"></div>
        <div id="apiReferenceMessage">
            <p>Available LIFF methods vary depending on the browser you use to open the LIFF app.</p>
            <p>Please refer to the <a href="https://developers.line.biz/en/reference/liff/#initialize-liff-app">API reference page</a> for more information.</p>
        </div>
    </div>
</div>

<div id="liffIdErrorMessage" class="hidden">
    <p>You have not assigned any value for LIFF ID.</p>
    <p>If you are running the app using Node.js, please set the LIFF ID as an environment variable in your Heroku account follwing the below steps: </p>
    <code id="code-block">
        <ol>
            <li>Go to `Dashboard` in your Heroku account.</li>
            <li>Click on the app you just created.</li>
            <li>Click on `Settings` and toggle `Reveal Config Vars`.</li>
            <li>Set `MY_LIFF_ID` as the key and the LIFF ID as the value.</li>
            <li>Your app should be up and running. Enter the URL of your app in a web browser.</li>
        </ol>
    </code>
    <p>If you are using any other platform, please add your LIFF ID in the <code>index.html</code> file.</p>
    <p>For more information about how to add your LIFF ID, see <a href="https://developers.line.biz/en/reference/liff/#initialize-liff-app">Initializing the LIFF app</a>.</p>
</div>

<div id="liffInitErrorMessage" class="hidden">
    <p>Something went wrong with LIFF initialization.</p>
    <p>LIFF initialization can fail if a user clicks "Cancel" on the "Grant permission" screen, or if an error occurs in the process of <code>liff.init()</code>.</p>
</div>

<div id="nodeLiffIdErrorMessage" class="hidden">
    <p>Unable to receive the LIFF ID as an environment variable.</p>
</div>
 -->


<script charset="utf-8" src="https://static.line-scdn.net/liff/edge/2.1/sdk.js"></script>
<script src="liff-starter.js"></script>

<script>

      window.onload = function()
      {
      const useNodeJS = false;   // if you are not using a node server, set this value to false
      const defaultLiffId = "1654462076-rvgP92W0";   // change the default LIFF value if you are not using a node server

      // DO NOT CHANGE THIS
      let myLiffId = "";

      // if node is used, fetch the environment variable and pass it to the LIFF method
      // otherwise, pass defaultLiffId
      if (useNodeJS) {
          fetch('/send-id')
              .then(function(reqResponse)
              {
                  return reqResponse.json();
              })
              .then(function(jsonResponse)
              {
                  myLiffId = jsonResponse.id;
                  initializeLiffOrDie(myLiffId);
              })
              .catch(function(error)
              {
                  document.getElementById("liffAppContent").classList.add('hidden');
                  document.getElementById("nodeLiffIdErrorMessage").classList.remove('hidden');
              });
      }
      else
      {
          myLiffId = defaultLiffId;
          initializeLiffOrDie(myLiffId);
      }
  };

  /**
  * Check if myLiffId is null. If null do not initiate liff.
  * @param {string} myLiffId The LIFF ID of the selected element
  */
  function initializeLiffOrDie(myLiffId)
  {
      if (!myLiffId)
      {
          document.getElementById("liffAppContent").classList.add('hidden');
          document.getElementById("liffIdErrorMessage").classList.remove('hidden');
      }
      else
      {
          initializeLiff(myLiffId);
      }
  }

  /**
  * Initialize LIFF
  * @param {string} myLiffId The LIFF ID of the selected element
  */
  function initializeLiff(myLiffId)
  {
      liff
          .init({
              liffId: myLiffId
          })
          .then(() =>
          {
              // start to use LIFF's api
              initializeApp();
          })
          .catch((err) =>
          {
              document.getElementById("liffAppContent").classList.add('hidden');
              document.getElementById("liffInitErrorMessage").classList.remove('hidden');
          });
  }

  /**
   * Initialize the app by calling functions handling individual app components
   */
  function initializeApp()
  {
      displayLiffData();
      displayIsInClientInfo();
      registerButtonHandlers();

      // check if the user is logged in/out, and disable inappropriate button

      if (liff.isLoggedIn())
      {
          document.getElementById('liffLoginButton').disabled = true;
      }
      else
      {
          document.getElementById('liffLogoutButton').disabled = true;
      }
  }

  /**
  * Display data generated by invoking LIFF methods
  */
  function displayLiffData()
  {
      document.getElementById('browserLanguage').textContent = liff.getLanguage();
      document.getElementById('sdkVersion').textContent = liff.getVersion();
      document.getElementById('lineVersion').textContent = liff.getLineVersion();
      document.getElementById('isInClient').textContent = liff.isInClient();
      document.getElementById('isLoggedIn').textContent = liff.isLoggedIn();
      document.getElementById('deviceOS').textContent = liff.getOS();
  }

  /**
  * Toggle the login/logout buttons based on the isInClient status, and display a message accordingly
  */
  function displayIsInClientInfo()
  {
      if (liff.isInClient())
      {
          document.getElementById('liffLoginButton').classList.toggle('hidden');
          document.getElementById('liffLogoutButton').classList.toggle('hidden');
          document.getElementById('isInClientMessage').textContent = 'You are opening the app in the in-app browser of LINE.';
      }
      else
      {
          document.getElementById('isInClientMessage').textContent = 'You are opening the app in an external browser.';
      }
  }

  /**
  * Register event handlers for the buttons displayed in the app
  */
  function registerButtonHandlers()
  {
      // openWindow call
      document.getElementById('openWindowButton').addEventListener('click', function()
      {
          liff.openWindow(
          {
              url: 'https://line.me',
              external: true
          });
      });

      // closeWindow call
      document.getElementById('closeWindowButton').addEventListener('click', function()
      {
          if (!liff.isInClient())
          {
              sendAlertIfNotInClient();
          }
          else
          {
              liff.closeWindow();
          }
      });

      // sendMessages call
      document.getElementById('sendMessageButton').addEventListener('click', function()
      {
          if (!liff.isInClient())
          {
              sendAlertIfNotInClient();
          }
          else
          {
              liff.sendMessages([
              {
                  'type': 'text',
                  'text': "You've successfully sent a message! Hooray!"
              }]).then(function()
              {
                  window.alert('Message sent');
              }).catch(function(error)
              {
                  window.alert('Error sending message: ' + error);
              });
          }
      });

      // scanCode call
      document.getElementById('scanQrCodeButton').addEventListener('click', function()
      {
          if (!liff.isInClient())
          {
              sendAlertIfNotInClient();
          }
          else
          {
              liff.scanCode().then(result =>
              {
                  // e.g. result = { value: "Hello LIFF app!" }
                  const stringifiedResult = JSON.stringify(result);
                  document.getElementById('scanQrField').textContent = stringifiedResult;
                  toggleQrCodeReader();
              }).catch(err =>
              {
                  document.getElementById('scanQrField').textContent = "scanCode failed!";
              });
          }
      });

      // get access token
      document.getElementById('getAccessToken').addEventListener('click', function()
      {
          if (!liff.isLoggedIn() && !liff.isInClient())
          {
              alert('To get an access token, you need to be logged in. Please tap the "login" button below and try again.');
          }
          else
          {
              const accessToken = liff.getAccessToken();
              document.getElementById('accessTokenField').textContent = accessToken;
              toggleAccessToken();
          }
      });

      // get profile call
      document.getElementById('getProfileButton').addEventListener('click', function()
      {
          liff.getProfile().then(function(profile)
          {
              document.getElementById('userIdProfileField').textContent = profile.userId;
              document.getElementById('displayNameField').textContent = profile.displayName;

              const profilePictureDiv = document.getElementById('profilePictureDiv');
              if (profilePictureDiv.firstElementChild) {
                  profilePictureDiv.removeChild(profilePictureDiv.firstElementChild);
              }
              const img = document.createElement('img');
              img.src = profile.pictureUrl;
              img.alt = 'Profile Picture';
              profilePictureDiv.appendChild(img);

              document.getElementById('statusMessageField').textContent = profile.statusMessage;
              toggleProfileData();
          }).catch(function(error)
          {
              window.alert('Error getting profile: ' + error);
          });
      });

      document.getElementById('shareTargetPicker').addEventListener('click', function()
      {
          if (!liff.isInClient())
          {
              sendAlertIfNotInClient();
          }
          else
          {
              if (liff.isApiAvailable('shareTargetPicker'))
              {
                  liff.shareTargetPicker([
                      {
                          'type': 'text',
                          'text': 'Hello, World!'
                      }
                  ])
                      .then(
                          document.getElementById('shareTargetPickerMessage').textContent = "Share target picker was launched."
                      ).catch(function(res)
                      {
                          document.getElementById('shareTargetPickerMessage').textContent = "Failed to launch share target picker.";
                      });
              }
          }
      });

      // login call, only when external browser is used
      document.getElementById('liffLoginButton').addEventListener('click', function() {
          if (!liff.isLoggedIn())
          {
              // set `redirectUri` to redirect the user to a URL other than the front page of your LIFF app.
              liff.login();
          }
      });

      // logout call only when external browse
      document.getElementById('liffLogoutButton').addEventListener('click', function() {
          if (liff.isLoggedIn())
          {
              liff.logout();
              window.location.reload();
          }
      });
  }

  /**
  * Alert the user if LIFF is opened in an external browser and unavailable buttons are tapped
  */
  function sendAlertIfNotInClient()
  {
      alert('This button is unavailable as LIFF is currently being opened in an external browser.');
  }

  /**
  * Toggle access token data field
  */
  function toggleAccessToken()
  {
      toggleElement('accessTokenData');
  }

  /**
  * Toggle profile info field
  */
  function toggleProfileData()
  {
      toggleElement('profileInfo');
  }

  /**
  * Toggle scanCode result field
  */
  function toggleQrCodeReader()
  {
      toggleElement('scanQr');
  }

  /**
  * Toggle specified element
  * @param {string} elementId The ID of the selected element
  */
  function toggleElement(elementId)
  {
      const elem = document.getElementById(elementId);
      if (elem.offsetWidth > 0 && elem.offsetHeight > 0)
      {
          elem.style.display = 'none';
      }
      else
      {
          elem.style.display = 'block';
      }
  }
</script>
