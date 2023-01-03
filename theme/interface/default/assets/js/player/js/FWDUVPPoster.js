/* Thumb */
(function (window){
	
	var FWDUVPPoster = function(
			parent,
			showPoster,
			posterBackgroundColor_str
		){
		
		var self  = this;
		var prototype = FWDUVPPoster.prototype;
		
		
		this.img_img = new Image();
		this.img_do = null;
		this.imgW = 0;
		this.imgH = 0;
		this.finalW = 0;
		this.finalH = 0;
		this.finalX = 0;
		this.finalY = 0;
		
		this.curPath_str;
		this.posterBackgroundColor_str = posterBackgroundColor_str;
		
		this.isTransparent_bl = false;
		this.showPoster_bl = showPoster;
		this.showOrLoadOnMobile_bl = false;
		this.isShowed_bl = true;
		this.allowToShow_bl = true;
		this.isMobile_bl = FWDUVPUtils.isMobile;
	
		this.init = function(){
			self.img_img = new Image();
			self.img_do = new FWDUVPDisplayObject("img");
			self.hide();
		};
		
		this.positionAndResize = function(){
			if(!parent.vidStageWidth) return;
			self.setWidth(parent.tempVidStageWidth);
			self.setHeight(parent.tempVidStageHeight);
		
			if(!self.imgW) return;
			var scX = parent.tempVidStageWidth/self.imgW;
			var scY = parent.tempVidStageHeight/self.imgH;
			var ttSc;
			
			if(scX <= scY){
				ttSc = scX;
			}else{
				ttSc = scY;
			}
			
			self.finalW = Math.round(ttSc * self.imgW);
			self.finalH = Math.round(ttSc * self.imgH);
			self.finalX = parseInt((parent.tempVidStageWidth - self.finalW)/2);
			//if(parent.controller_do && parent.controller_do.isShowed_bl){
				//self.finalY = parseInt((parent.tempVidStageHeight - self.finalH - parent.controller_do.h)/2) ;
			//}else{
				self.finalY = parseInt((parent.tempVidStageHeight - self.finalH)/2);
			//}
		
			self.img_do.setX(self.finalX);
			self.img_do.setY(self.finalY);
			self.img_do.setWidth(self.finalW);
			self.img_do.setHeight(self.finalH);		
		};
		
		this.setPoster = function(path){
			
			if(path && (FWDUVPUtils.trim(path) == "") || path =="none"){
				self.showOrLoadOnMobile_bl = true;
				self.isTransparent_bl = true;
				self.show();
				return;
			}else if(path == "youtubemobile"){
				self.isTransparent_bl = false;
				self.showOrLoadOnMobile_bl = false;
				self.img_img.src = null;
				self.imgW = 0;
				return;
			}else if(path == self.curPath_str){
				self.isTransparent_bl = false;
				self.showOrLoadOnMobile_bl = true;
			}else{
				self.isTransparent_bl = false
			}
			
			if(self.isTransparent_bl){
				self.getStyle().backgroundColor = "transparent";
			}else{
				self.getStyle().backgroundColor = self.posterBackgroundColor_str;
			}
			
			self.isTransparent_bl = false;
			self.showOrLoadOnMobile_bl = true;
			self.curPath_str = path;
			if(self.allowToShow_bl) self.isShowed_bl = false;
			if(!path) return;
			if(self.img_do) self.img_do.src = "";
			self.img_img.onload = self.posterLoadHandler;
			self.img_img.src = self.curPath_str;
		};
		
		this.posterLoadHandler = function(e){
			self.imgW = self.img_img.width;
			self.imgH = self.img_img.height;
			self.img_do.setScreen(self.img_img);
			self.addChild(self.img_do);
			self.show();
			self.positionAndResize();
		};
		
		//################################//
		/* show / hide */
		//################################//
		this.show = function(allowToShow_bl){
			if(!self.allowToShow_bl || self.isShowed_bl || !self.showOrLoadOnMobile_bl) return;
			
			self.isShowed_bl = true;
			
			if(self.isTransparent_bl){
				if(self.alpha != 0) self.setAlpha(0);
			}else {
				if(self.alpha != 1) self.setAlpha(1);
			}
			
			self.setVisible(true);
			
			if(!self.isMobile_bl && !self.isTransparent_bl){
				FWDAnimation.killTweensOf(self);
				self.setAlpha(0);
				FWDAnimation.to(self, .6, {alpha:1, delay:.4});	
			}
			
			self.positionAndResize();
		};
		
		this.hide = function(overwrite){
			if(!self.isShowed_bl && !overwrite) return;
			FWDAnimation.killTweensOf(self);
			self.isShowed_bl = false;
			self.setVisible(false);
		};
		
		
		this.init();
	};
	
	/* set prototype */
    FWDUVPPoster.setPrototype = function(){
    	FWDUVPPoster.prototype = new FWDUVPDisplayObject("div");
    };
    
    FWDUVPPoster.prototype = null;
	window.FWDUVPPoster = FWDUVPPoster;
}(window));