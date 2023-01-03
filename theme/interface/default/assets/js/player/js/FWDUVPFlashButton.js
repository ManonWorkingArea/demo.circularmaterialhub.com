/* FWDUVPFlashButton */
(function (window){
var FWDUVPFlashButton = function(
			nImgPath, 
			sImgPath,
			flashFPath,
			flashButtonName,
			overPath,
			outPath,
			clickPath,
			copyPath,
			buttonWidth,
			buttonHeight, 
			useHEXColorsForSkin_bl,
			normalButtonsColor_str,
			selectedButtonsColor_str
		){
		
		var self = this;
		var prototype = FWDUVPFlashButton.prototype;
		
		this.useHEXColorsForSkin_bl = useHEXColorsForSkin_bl;
		this.normalButtonsColor_str = normalButtonsColor_str;
		this.selectedButtonsColor_str = selectedButtonsColor_str;
		
		this.nImg_img = null;
		this.sImg_img = null;
	
		this.n_do;
		this.s_do;
		
		this.nImgPath_str = nImgPath;
		this.sImgPath_str = sImgPath;
		this.flashPath_str = flashFPath;
		this.flashButtonName_str = flashButtonName;
		this.overPath_str = overPath;
		this.outPath_str = outPath;
		this.clickPath_str = clickPath;
		this.copyPath_str = copyPath;
	
		this.linkFlashObject = null;
		
		this.buttonWidth = buttonWidth;
		this.buttonHeight = buttonHeight;
		
		this.isMobile_bl = FWDUVPUtils.isMobile;
		this.hasPointerEvent_bl = FWDUVPUtils.hasPointerEvent;
		this.isDisabled_bl = false;
		
		//##########################################//
		/* initialize this */
		//##########################################//
		this.init = function(){
			self.setWidth(self.buttonWidth);
			self.setHeight(self.buttonHeight);
			if(self.isMobile_bl) return;
			self.setupMainContainers();
			self.setupFalshButton();
			self.setButtonMode(true);
		};
		
		//##########################################//
		/* setup main containers */
		//##########################################//
		this.setupMainContainers = function(){
			
			self.nImg = new Image();
			self.nImg.src = self.nImgPath_str;
			
			if(self.useHEXColorsForSkin_bl){
				self.n_do = new FWDUVPTransformDisplayObject("div");
				self.n_do.setWidth(self.buttonWidth);
				self.n_do.setHeight(self.buttonHeight);
				self.nImg.onload = function(){	
					self.n_do_canvas = FWDUVPUtils.getCanvasWithModifiedColor(self.nImg, self.normalButtonsColor_str).canvas;
					self.n_do.screen.appendChild(self.n_do_canvas);
				}
				self.addChild(self.n_do);
			}else{
				self.n_do = new FWDUVPDisplayObject("img");
				self.n_do.setScreen(self.nImg);
				self.n_do.setWidth(self.buttonWidth);
				self.n_do.setHeight(self.buttonHeight);
				self.addChild(self.n_do);
			}
		
			self.sImg = new Image();
			self.sImg.src = self.sImgPath_str;
			
			if(self.useHEXColorsForSkin_bl){
				self.s_do = new FWDUVPTransformDisplayObject("div");
				self.s_do.setWidth(self.buttonWidth);
				self.s_do.setHeight(self.buttonHeight);
				self.sImg.onload = function(){	
					self.s_do_canvas = FWDUVPUtils.getCanvasWithModifiedColor(self.sImg, self.selectedButtonsColor_str).canvas;
					self.s_do.screen.appendChild(self.s_do_canvas);
				}
				self.s_do.setAlpha(0);
				self.addChild(self.s_do);
			}else{
				self.s_do = new FWDUVPDisplayObject("img");
				self.s_do.setScreen(self.sImg);
				self.s_do.setWidth(self.buttonWidth);
				self.s_do.setHeight(self.buttonHeight);
				self.s_do.setAlpha(0);
				self.addChild(self.s_do);
			}
			
			if(self.screen.addEventListener){	
				self.screen.addEventListener("mouseover", self.onMouseOver);
				self.screen.addEventListener("mouseout", self.onMouseOut);
				self.screen.addEventListener("mouseup", self.onMouseUp);
			}else if(self.screen.attachEvent){
				self.screen.attachEvent("onmouseover", self.onMouseOver);
				self.screen.attachEvent("onmouseout", self.onMouseOut);
				self.screen.attachEvent("onmouseup", self.onMouseUp);
			}
		};
		
		
		this.onMouseOver = function(e){
			if(!e.pointerType || e.pointerType == "mouse"){
				if(self.isDisabled_bl || self.isSelectedFinal_bl) return;
				self.setSelectedState();
			}
		};

		this.onMouseOut = function(e){
			if(!e.pointerType || e.pointerType == "mouse"){
				self.setNormalState();
			}
		};
		
		this.onMouseUp = function(e){
			if(FWDUVPFlashTest.hasFlashPlayerVersion("9.0.18")) return;
			if(e.preventDefault) e.preventDefault();
			if(self.isDisabled_bl || e.button == 2) return;
			self.dispatchEvent(FWDUVPFlashButton.CLICK);
		};
		
		//#############################################//
		/* Setup flash button */
		//##############################################//
		this.setupFalshButton = function(){
			if(!FWDUVPFlashTest.hasFlashPlayerVersion("9.0.18")) return;
			
			var flashCopyLInkObjectMarkup_str = '<object id="' + self.flashButtonName_str + '"classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="100%" height="100%"><param name="movie" value="' + self.flashPath_str + '"/><param name="wmode" value="transparent"/><param name="scale" value="noscale"/><param name=FlashVars value="clickPath_str=' + self.clickPath_str + '&overPath_str=' + self.overPath_str + '&outPath_str=' + self.outPath_str + '&copyPath_str=' + self.copyPath_str + '"/><object type="application/x-shockwave-flash" data="' + self.flashPath_str + '" width="100%" height="100%"><param name="movie" value="' + self.flashPath_str + '"/><param name="wmode" value="transparent"/><param name="scale" value="noscale"/><param name=FlashVars value="clickPath_str=' + self.clickPath_str + '&overPath_str=' + self.overPath_str + '&outPath_str=' + self.outPath_str + '&copyPath_str=' + self.copyPath_str + '"/></object></object>';
			
			var linkDumy_do = new FWDUVPDisplayObject("div");
			linkDumy_do.setBackfaceVisibility();
			linkDumy_do.setResizableSizeAfterParent();	
			linkDumy_do.screen.innerHTML = flashCopyLInkObjectMarkup_str;
			self.addChild(linkDumy_do);
			
			self.linkFlashObject = linkDumy_do.screen.firstChild;
			if(!FWDUVPUtils.isIE) self.linkFlashObject = self.linkFlashObject.getElementsByTagName("object")[0];
			
		};
		
		//####################################//
		/* Set normal / selected state */
		//####################################//
		this.setNormalState = function(){
			FWDAnimation.killTweensOf(self.s_do);
			FWDAnimation.to(self.s_do, .5, {alpha:0, ease:Expo.easeOut});	
		};
		
		this.setSelectedState = function(){
			FWDAnimation.killTweensOf(self.s_do);
			FWDAnimation.to(self.s_do, .5, {alpha:1, ease:Expo.easeOut});
		};
		
		//##########################################//
		/* Update HEX color of a canvaas */
		//##########################################//
		self.updateHEXColors = function(normalColor_str, selectedColor_str){
			FWDUVPUtils.changeCanvasHEXColor(self.nImg, self.n_do_canvas, normalColor_str);
			FWDUVPUtils.changeCanvasHEXColor(self.sImg, self.s_do_canvas, selectedColor_str);
		}
	
		self.init();
	};
	
	/* set prototype */
	FWDUVPFlashButton.setPrototype = function(){
		FWDUVPFlashButton.prototype = null;
		FWDUVPFlashButton.prototype = new FWDUVPDisplayObject("div");
	};
	
	FWDUVPFlashButton.CLICK = "onClick";
	FWDUVPFlashButton.MOUSE_OVER = "onMouseOver";
	FWDUVPFlashButton.SHOW_TOOLTIP = "showTooltip";
	FWDUVPFlashButton.MOUSE_OUT = "onMouseOut";
	FWDUVPFlashButton.MOUSE_UP = "onMouseDown";
	
	FWDUVPFlashButton.prototype = null;
	window.FWDUVPFlashButton = FWDUVPFlashButton;
}(window));