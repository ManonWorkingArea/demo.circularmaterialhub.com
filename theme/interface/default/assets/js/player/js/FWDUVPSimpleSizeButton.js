/* FWDUVPSimpleSizeButton */
(function (window){
var FWDUVPSimpleSizeButton = function(
		nImgPath, 
		sImgPath,
		buttonWidth,
		buttonHeight, 
	    useHEXColorsForSkin_bl,
	    normalButtonsColor_str,
	    selectedButtonsColor_str){
		
		var self = this;
		var prototype = FWDUVPSimpleSizeButton.prototype;
		
		this.nImg_img = null;
		this.sImg_img = null;
	
		this.n_do;
		this.s_do;
		
		this.useHEXColorsForSkin_bl = useHEXColorsForSkin_bl;
		this.normalButtonsColor_str = normalButtonsColor_str;
		this.selectedButtonsColor_str = selectedButtonsColor_str;
		
		this.nImgPath_str = nImgPath;
		this.sImgPath_str = sImgPath;
		
		this.buttonWidth = buttonWidth;
		this.buttonHeight = buttonHeight;
		
		this.isMobile_bl = FWDUVPUtils.isMobile;
		this.hasPointerEvent_bl = FWDUVPUtils.hasPointerEvent;
		this.isDisabled_bl = false;
		
		
		//##########################################//
		/* initialize this */
		//##########################################//
		this.init = function(){
			self.setupMainContainers();
			self.setWidth(self.buttonWidth);
			self.setHeight(self.buttonHeight);
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
					self.n_do_canvas = FWDUVPUtils.getCanvasWithModifiedColor(self.nImg, self.normalButtonsColor_str, false, self.buttonWidth, self.buttonHeight).canvas;
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
					self.s_do_canvas = FWDUVPUtils.getCanvasWithModifiedColor(self.sImg, self.selectedButtonsColor_str, false, self.buttonWidth, self.buttonHeight).canvas;
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
			
			self.screen.onmouseover = self.setSelectedState;
			self.screen.onmouseout = self.setNormalState;
			self.screen.onclick = self.onClick;
			
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
		
		this.onClick = function(e){
			self.dispatchEvent(FWDUVPSimpleSizeButton.MOUSE_UP);
		};
		
		//##########################################//
		/* Update HEX color of a canvaas */
		//##########################################//
		self.updateHEXColors = function(normalColor_str, selectedColor_str){
			FWDUVPUtils.changeCanvasHEXColor(self.nImg, self.n_do_canvas, normalColor_str, false, self.buttonWidth, self.buttonHeight);
			FWDUVPUtils.changeCanvasHEXColor(self.sImg, self.s_do_canvas, selectedColor_str, false, self.buttonWidth, self.buttonHeight);
		}
			
		
		//###################################################//
		/* Destory */
		//###################################################//
		this.destroy = function(){
			FWDAnimation.killTweensOf(self.n_do);
			
			self.n_do.destroy();
			this.s_do.destroy();
		
			self.screen.onmouseover = null;
			self.screen.onmouseout = null;
			self.screen.onclick = null;
			self.nImg_img = null;
			self.sImg_img = null;
			
			self = null;
			prototype = null;
			FWDUVPSimpleSizeButton.prototype = null;
		};
		
	
		self.init();
	};
	
	/* set prototype */
	FWDUVPSimpleSizeButton.setPrototype = function(){
		FWDUVPSimpleSizeButton.prototype = null;
		FWDUVPSimpleSizeButton.prototype = new FWDUVPTransformDisplayObject("div", "relative");
	};
	
	FWDUVPSimpleSizeButton.MOUSE_UP = "onClick";
	
	FWDUVPSimpleSizeButton.prototype = null;
	window.FWDUVPSimpleSizeButton = FWDUVPSimpleSizeButton;
}(window));