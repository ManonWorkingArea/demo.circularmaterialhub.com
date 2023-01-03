/* FWDUVPPupupAds */
(function (window){
var FWDUVPPupupAds = function(parent, data){
		
		var self = this;
		var prototype = FWDUVPPupupAds.prototype;
		
		this.parent = parent;
		this.main_do = null;
		this.reader = null;
		this.subtitiles_ar = null;
		
		this.totalAds = 0;
		self.popupAds_ar;
		self.popupAdsButtons_ar;
		
		this.hasText_bl = false;
		this.isLoaded_bl = false;
		this.isMobile_bl = FWDUVPUtils.isMobile;
		this.hasPointerEvent_bl = FWDUVPUtils.hasPointerEvent;
		this.showSubtitleByDefault_bl = data.showSubtitleByDefault_bl;
		self.normalButtonsColor_str = data.normalButtonsColor_str;
		self.selectedButtonsColor_str = data.selectedButtonsColor_str;
		
		this.setSizeOnce_bl = false;
		
		//##########################################//
		/* initialize self */
		//##########################################//
		self.init = function(){
			if(data.skinPath_str.indexOf("hex_white") != -1){
				self.selectedButtonsColor_str = "#FFFFFF";
			} 
			self.setOverflow("visible");
			//self.getStyle().pointerEvents = "none";
			self.getStyle().cursor = "default";
			self.setBkColor("#FF0000")
			self.setVisible(false);
		};
		
		//##########################################//
		/* Reset popup buttons ads */
		//##########################################//
		this.resetPopups = function(popupAds_ar){
			self.hideAllPopupButtons(true);
			
			
			self.popupAds_ar = popupAds_ar;
			self.totalAds = self.popupAds_ar.length;
			
			var popupAdButton;
			self.popupAdsButtons_ar = [];
			
			for(var i=0; i<self.totalAds; i++){
				FWDUVPPopupAddButton.setPrototype();
				popupAdButton = new FWDUVPPopupAddButton(
						self,
						self.popupAds_ar[i].source,
						self.popupAds_ar[i].start,
						self.popupAds_ar[i].end,
						self.popupAds_ar[i].link,
						self.popupAds_ar[i].trget,
						i,
						data.popupAddCloseNPath_str,
						data.popupAddCloseSPath_str,
						data.showPopupAdsCloseButton_bl,
						data.useHEXColorsForSkin_bl,
						self.normalButtonsColor_str,
						self.selectedButtonsColor_str
				);
				self.popupAdsButtons_ar[i] = popupAdButton;
				self.addChild(popupAdButton);
			}
		};
		
		//#####################################//
		/* Update text */
		//#####################################//
		this.update = function(duration){
			
			if(self.totalAds == 0) return;
			var popupAdButton;
			
			for(var i=0; i<self.totalAds; i++){
				popupAdButton = self.popupAdsButtons_ar[i];
				if(duration >= popupAdButton.start && duration <= popupAdButton.end){
					popupAdButton.show();
				}else{
					popupAdButton.hide();
				}
			}	
		};
		
		this.position = function(animate){
			if(self.totalAds == 0) return;
			var popupAdButton;
			
			for(var i=0; i<self.totalAds; i++){
				popupAdButton = self.popupAdsButtons_ar[i];
				popupAdButton.resizeAndPosition(animate);
			}	
		};
		
		this.hideAllPopupButtons = function(remove){
			if(self.totalAds == 0) return;
			var popupAdButton;
			
			for(var i=0; i<self.totalAds; i++){
				popupAdButton = self.popupAdsButtons_ar[i];
				popupAdButton.hide(remove);
			}	
			if(remove){
				self.popupAdsButtons_ar = null;
				self.totalAds = 0;
			}
		};
		
		this.updateHEXColors =  function(normalColor_str, selectedColor_str){
			
			self.normalButtonsColor_str = normalColor_str;
			self.selectedButtonsColor_str = selectedColor_str;
			if(self.popupAdsButtons_ar){
				for(var i=0; i<self.popupAdsButtons_ar.length; i++){
					if(self.popupAdsButtons_ar[i]['imageSource']) self.popupAdsButtons_ar[i].updateHEXColors(normalColor_str, selectedColor_str);	
				}
			}
		}
		
		self.init();
	};
	
	/* set prototype */
	FWDUVPPupupAds.setPrototype = function(){
		FWDUVPPupupAds.prototype = new FWDUVPDisplayObject("div");
	};
	
	FWDUVPPupupAds.LOAD_ERROR = "error";
	FWDUVPPupupAds.LOAD_COMPLETE = "complete";
	
	
	FWDUVPPupupAds.prototype = null;
	window.FWDUVPPupupAds = FWDUVPPupupAds;
}(window));