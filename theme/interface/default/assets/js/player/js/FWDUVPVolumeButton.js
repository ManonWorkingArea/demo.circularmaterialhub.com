/* FWDUVPVolumeButton */
(function (window){
var FWDUVPVolumeButton = function(nImg, sPath, dPath, useHEXColorsForSkin_bl,
								  normalButtonsColor_str,
								  selectedButtonsColor_str){
		
		var self = this;
		var prototype = FWDUVPVolumeButton.prototype;
		
		this.nImg = nImg;
		this.sPath_str = sPath;
		this.dPath_str = dPath;
		
		this.n_sdo;
		this.s_sdo;
		this.d_sdo;
		
		this.toolTipLabel_str;
		
		this.totalWidth = this.nImg.width;
		this.totalHeight = this.nImg.height;
		
		this.useHEXColorsForSkin_bl = useHEXColorsForSkin_bl;
		this.normalButtonsColor_str = normalButtonsColor_str;
		this.selectedButtonsColor_str = selectedButtonsColor_str;
		
		this.isSetToDisabledState_bl = false;
		this.isDisabled_bl = false;
		this.isSelectedFinal_bl = false;
		this.isActive_bl = false;
		this.isMobile_bl = FWDUVPUtils.isMobile;
		this.hasPointerEvent_bl = FWDUVPUtils.hasPointerEvent;
		this.allowToCreateSecondButton_bl = !self.isMobile_bl || self.hasPointerEvent_bl;
	
		//##########################################//
		/* initialize self */
		//##########################################//
		self.init = function(){
			self.setupMainContainers();
		};
		
		//##########################################//
		/* setup main containers */
		//##########################################//
		self.setupMainContainers = function(){
		
			if(self.useHEXColorsForSkin_bl){
				self.n_sdo = new FWDUVPTransformDisplayObject("div");
				self.n_sdo.setWidth(self.totalWidth);
				self.n_sdo.setHeight(self.totalHeight);
				self.n_sdo_canvas = FWDUVPUtils.getCanvasWithModifiedColor(self.nImg, self.normalButtonsColor_str).canvas;
				self.n_sdo.screen.appendChild(self.n_sdo_canvas);
				self.addChild(self.n_sdo);
			}else{
				self.n_sdo = new FWDUVPTransformDisplayObject("img");	
				self.n_sdo.setScreen(self.nImg);
				self.addChild(self.n_sdo);
			}
			
			if(self.allowToCreateSecondButton_bl){
				
				self.img1 = new Image();
				self.img1.src = self.sPath_str;
				var img2 = new Image();
				self.sImg = img2;
				
				if(self.useHEXColorsForSkin_bl){
					self.s_sdo = new FWDUVPTransformDisplayObject("div");
					self.s_sdo.setWidth(self.totalWidth);
					self.s_sdo.setHeight(self.totalHeight);
					self.img1.onload = function(){
						
						self.s_sdo_canvas = FWDUVPUtils.getCanvasWithModifiedColor(self.img1, self.selectedButtonsColor_str).canvas;
						self.s_sdo.screen.appendChild(self.s_sdo_canvas);
					}
					self.s_sdo.setAlpha(0);
					self.addChild(self.s_sdo);
				}else{
					self.s_sdo = new FWDUVPDisplayObject("img");
					self.s_sdo.setScreen(self.img1);
					self.s_sdo.setWidth(self.totalWidth);
					self.s_sdo.setHeight(self.totalHeight);
					self.s_sdo.setAlpha(0);
					self.addChild(self.s_sdo);
				}
			
				if(self.dPath_str){
					img2.src = self.dPath_str;
					self.d_sdo = new FWDUVPDisplayObject("img");
					self.d_sdo.setScreen(img2);
					self.d_sdo.setWidth(self.totalWidth);
					self.d_sdo.setHeight(self.totalHeight);
					self.d_sdo.setX(-100);
					self.addChild(self.d_sdo);
				};
			}
			
			self.setWidth(self.totalWidth);
			self.setHeight(self.totalHeight);
			self.setButtonMode(true);
			
			if(self.isMobile_bl){
				if(self.hasPointerEvent_bl){
					self.screen.addEventListener("pointerdown", self.onMouseUp);
					self.screen.addEventListener("pointerover", self.onMouseOver);
					self.screen.addEventListener("pointerout", self.onMouseOut);
				}else{
					self.screen.addEventListener("touchend", self.onMouseUp);
				}
			}else if(self.screen.addEventListener){	
				self.screen.addEventListener("mouseover", self.onMouseOver);
				self.screen.addEventListener("mouseout", self.onMouseOut);
				self.screen.addEventListener("mousedown", self.onMouseUp);
			}else if(self.screen.attachEvent){
				self.screen.attachEvent("onmouseover", self.onMouseOver);
				self.screen.attachEvent("onmouseout", self.onMouseOut);
				self.screen.attachEvent("onmousedown", self.onMouseUp);
			}
		};
		
		self.onMouseOver = function(e){
			self.dispatchEvent(FWDUVPVolumeButton.SHOW_TOOLTIP, {e:e});
			if(!e.pointerType || e.pointerType == e.MSPOINTER_TYPE_MOUSE){
				if(self.isDisabled_bl || self.isSelectedFinal_bl) return;
				self.dispatchEvent(FWDUVPVolumeButton.MOUSE_OVER, {e:e});
				FWDAnimation.killTweensOf(self.s_sdo);
				FWDAnimation.to(self.s_sdo, .5, {alpha:1, delay:.1, ease:Expo.easeOut});
			}
		};
			
		self.onMouseOut = function(e){
			if(!e.pointerType || e.pointerType == e.MSPOINTER_TYPE_MOUSE){
				if(self.isDisabled_bl || self.isSelectedFinal_bl) return;
				self.dispatchEvent(FWDUVPVolumeButton.MOUSE_OUT, {e:e});
				FWDAnimation.killTweensOf(self.s_sdo);
				FWDAnimation.to(self.s_sdo, .5, {alpha:0, ease:Expo.easeOut});	
			}
		};
		
		self.onMouseUp = function(e){
			if(e.preventDefault) e.preventDefault();
			if(self.isDisabled_bl || e.button == 2 || self.isSelectedFinal_bl) return;
			self.dispatchEvent(FWDUVPVolumeButton.MOUSE_UP, {e:e});
		};
		
		//###################################//
		/* set slected / normal state */
		//##################################//
		this.setNormalState = function(animate){
			if(!self.isSelected_bl) return;
			self.isSelected_bl = false; 
			FWDAnimation.killTweensOf(self.s_sdo);
			if(animate){
				FWDAnimation.to(self.s_sdo, .5, {alpha:0, delay:.1, ease:Expo.easeOut});
			}else{
				self.s_sdo.setAlpha(0);
			}
		};
		
		this.setSelectedState = function(animate){
			if(self.isSelected_bl) return;
			self.isSelected_bl = true; 
			FWDAnimation.killTweensOf(self.s_sdo);
			if(animate){
				FWDAnimation.to(self.s_sdo, .5, {alpha:1, delay:.1, ease:Expo.easeOut});
			}else{
				self.s_sdo.setAlpha(1);
			}
		};
		
		//##############################//
		// set select / deselect final.
		//##############################//
		self.setSelctedFinal = function(){
			self.isSelectedFinal_bl = true;
			FWDAnimation.killTweensOf(self.s_sdo);
			FWDAnimation.to(self.s_sdo, .8, {alpha:1, ease:Expo.easeOut});
			self.setButtonMode(false);
		};
		
		self.setUnselctedFinal = function(){
			self.isSelectedFinal_bl = false;
			FWDAnimation.to(self.s_sdo, .8, {alpha:0, delay:.1, ease:Expo.easeOut});
			self.setButtonMode(true);
		};
		
		//####################################//
		/* Disable / enable */
		//####################################//
		this.setDisabledState = function(){
			if(self.isSetToDisabledState_bl) return;
			self.d_sdo.setX(0);
			self.isSetToDisabledState_bl = true;
			if(self.isMobile_bl){
				self.d_sdo.setX(0);
			}else{
				FWDAnimation.killTweensOf(self.d_sdo);
				FWDAnimation.to(self.d_sdo, .8, {alpha:1, ease:Expo.easeOut});
			}
		};
		
		this.setEnabledState = function(){
			if(!self.isSetToDisabledState_bl) return;
			self.isSetToDisabledState_bl = false;
			self.d_sdo.setX(-100);
			if(self.isMobile_bl){
				self.d_sdo.setX(-100);
			}else{
				FWDAnimation.killTweensOf(self.d_sdo);
				FWDAnimation.to(self.d_sdo, .8, {alpha:0, delay:.1, ease:Expo.easeOut});
			}
		};
		
		this.disable = function(){
			self.isDisabled_bl = true;
			self.setButtonMode(false);
		};
		
		this.enable = function(){
			self.isDisabled_bl = false;
			self.setButtonMode(true);
		};
		
		//##########################################//
		/* Update HEX color of a canvaas */
		//##########################################//
		self.updateHEXColors = function(normalColor_str, selectedColor_str){
			FWDUVPUtils.changeCanvasHEXColor(self.nImg, self.n_sdo_canvas, normalColor_str);
			FWDUVPUtils.changeCanvasHEXColor(self.img1, self.s_sdo_canvas, selectedColor_str);
		}
		
		//##############################//
		/* destroy */
		//##############################//
		self.destroy = function(){
			if(self.isMobile_bl){
				if(self.hasPointerEvent_bl){
					self.screen.removeEventListener("pointerdown", self.onMouseUp);
					self.screen.removeEventListener("pointerover", self.onMouseOver);
					self.screen.removeEventListener("pointerout", self.onMouseOut);
				}else{
					self.screen.removeEventListener("touchend", self.onMouseUp);
				}
			}else if(self.screen.removeEventListener){	
				self.screen.removeEventListener("mouseover", self.onMouseOver);
				self.screen.removeEventListener("mouseout", self.onMouseOut);
				self.screen.removeEventListener("mousedown", self.onMouseUp);
			}else if(self.screen.detachEvent){
				self.screen.detachEvent("onmouseover", self.onMouseOver);
				self.screen.detachEvent("onmouseout", self.onMouseOut);
				self.screen.detachEvent("onmousedown", self.onMouseUp);
			}
		
			FWDAnimation.killTweensOf(self.s_sdo);
			self.n_sdo.destroy();
			self.s_sdo.destroy();
			
			if(self.d_sdo){
				FWDAnimation.killTweensOf(self.d_sdo);
				self.d_sdo.destroy();
			}
			
			self.nImg = null;
			self.sImg = null;
			self.dImg = null;
			self.n_sdo = null;
			self.s_sdo = null;
			self.d_sdo = null;
			
			nImg = null;
			sImg = null;
			dImg = null;
			
			self.toolTipLabel_str = null;
			
			self.init = null;
			self.setupMainContainers = null;
			self.onMouseOver = null;
			self.onMouseOut = null;
			self.onClick = null;
			self.onMouseDown = null;  
			self.setSelctedFinal = null;
			self.setUnselctedFinal = null;
			
			self.setInnerHTML("");
			prototype.destroy();
			self = null;
			prototype = null;
			FWDUVPVolumeButton.prototype = null;
		};
	
		self.init();
	};
	
	/* set prototype */
	FWDUVPVolumeButton.setPrototype = function(){
		FWDUVPVolumeButton.prototype = null;
		FWDUVPVolumeButton.prototype = new FWDUVPDisplayObject("div");
	};
	
	FWDUVPVolumeButton.SHOW_TOOLTIP = "showToolTip"
	FWDUVPVolumeButton.CLICK = "onClick";
	FWDUVPVolumeButton.MOUSE_OVER = "onMouseOver";
	FWDUVPVolumeButton.MOUSE_OUT = "onMouseOut";
	FWDUVPVolumeButton.MOUSE_UP = "onMouseDown";
	
	FWDUVPVolumeButton.prototype = null;
	window.FWDUVPVolumeButton = FWDUVPVolumeButton;
}(window));