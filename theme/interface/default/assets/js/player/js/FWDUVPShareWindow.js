/* Info screen */
(function (window){
	
	var FWDUVPShareWindow = function(data, parent){
		
		var self = this;
		var prototype = FWDUVPShareWindow.prototype;
				
		this.embedColoseN_img = data.embedColoseN_img;
		
		this.bk_do = null;
		this.mainHolder_do = null;
		this.closeButton_do = null;
		
		this.buttons_ar = [];
		
		this.embedWindowBackground_str = data.embedWindowBackground_str;
		this.embedWindowCloseButtonMargins = data.embedWindowCloseButtonMargins;
			
		this.totalWidth = 0;
		this.stageWidth = 0;
		this.stageHeight = 0;
		this.minMarginXSpace = 20;
		this.hSpace = 20;
		this.minHSpace = 10;
		this.vSpace = 15;
		
		this.isShowed_bl = false;
		this.isMobile_bl = FWDUVPUtils.isMobile;
	
		//#################################//
		/* init */
		//#################################//
		this.init = function(){
			if(data.skinPath_str.indexOf("hex_white") != -1){
				self.selectedButtonsColor_str = "#FFFFFF";
			}else{
				self.selectedButtonsColor_str = data.selectedButtonsColor_str;
			}
			
			self.setBackfaceVisibility();
			self.mainHolder_do = new FWDUVPDisplayObject("div");
			self.mainHolder_do.hasTransform3d_bl = false;
			self.mainHolder_do.hasTransform2d_bl = false;
			self.mainHolder_do.setBackfaceVisibility();
			
			self.bk_do = new FWDUVPDisplayObject("div");
			self.bk_do.getStyle().width = "100%";
			self.bk_do.getStyle().height = "100%";
			self.bk_do.setAlpha(.9);
			self.bk_do.getStyle().background = "url('" + self.embedWindowBackground_str + "')";
			
			//setup close button
			FWDUVPSimpleButton.setPrototype();
			self.closeButton_do = new FWDUVPSimpleButton(data.shareClooseN_img, data.embedWindowClosePathS_str, undefined,
					true,
					data.useHEXColorsForSkin_bl,
					data.normalButtonsColor_str,
					self.selectedButtonsColor_str);
			self.closeButton_do.addListener(FWDUVPSimpleButton.MOUSE_UP, self.closeButtonOnMouseUpHandler);
			
			self.addChild(self.mainHolder_do);
			self.mainHolder_do.addChild(self.bk_do);
			self.mainHolder_do.addChild(self.closeButton_do); 
			
			this.setupButtons();
		};
	
		this.closeButtonOnMouseUpHandler = function(){
			if(!self.isShowed_bl) return;
			self.hide();
		};
		
	
		this.positionAndResize = function(){
			self.stageWidth = parent.stageWidth;
			self.stageHeight = parent.stageHeight;
				
			self.closeButton_do.setX(self.stageWidth - self.closeButton_do.w - self.embedWindowCloseButtonMargins);
			self.closeButton_do.setY(self.embedWindowCloseButtonMargins);
			
			self.setWidth(self.stageWidth);
			self.setHeight(self.stageHeight);
			self.mainHolder_do.setWidth(self.stageWidth);
			self.mainHolder_do.setHeight(self.stageHeight);
			self.positionButtons();
		};
		
		
		//###########################################//
		/* Setup buttons */
		//###########################################//
		this.setupButtons = function(){
			
			FWDUVPSimpleButton.setPrototype();
			self.facebookButton_do = new FWDUVPSimpleButton(data.facebookN_img, data.facebookSPath_str, undefined,
					true,
					data.useHEXColorsForSkin_bl,
					data.normalButtonsColor_str,
					data.selectedButtonsColor_str);
			self.facebookButton_do.addListener(FWDUVPSimpleButton.MOUSE_UP, self.facebookOnMouseUpHandler);
			this.buttons_ar.push(self.facebookButton_do);
			
			
			FWDUVPSimpleButton.setPrototype();
			self.googleButton_do = new FWDUVPSimpleButton(data.googleN_img, data.googleSPath_str, undefined,
					true,
					data.useHEXColorsForSkin_bl,
					data.normalButtonsColor_str,
					data.selectedButtonsColor_str);
			self.googleButton_do.addListener(FWDUVPSimpleButton.MOUSE_UP, self.googleOnMouseUpHandler);
			this.buttons_ar.push(self.googleButton_do);
			
			FWDUVPSimpleButton.setPrototype();
			self.twitterButton_do = new FWDUVPSimpleButton(data.twitterN_img, data.twitterSPath_str, undefined,
					true,
					data.useHEXColorsForSkin_bl,
					data.normalButtonsColor_str,
					data.selectedButtonsColor_str);
			self.twitterButton_do.addListener(FWDUVPSimpleButton.MOUSE_UP, self.twitterOnMouseUpHandler);
			this.buttons_ar.push(self.twitterButton_do);
			
			FWDUVPSimpleButton.setPrototype();
			self.likedinButton_do = new FWDUVPSimpleButton(data.likedInkN_img, data.likedInSPath_str, undefined,
					true,
					data.useHEXColorsForSkin_bl,
					data.normalButtonsColor_str,
					data.selectedButtonsColor_str);
			self.likedinButton_do.addListener(FWDUVPSimpleButton.MOUSE_UP, self.likedinOnMouseUpHandler);
			this.buttons_ar.push(self.likedinButton_do);
			
			FWDUVPSimpleButton.setPrototype();
			self.bufferButton_do = new FWDUVPSimpleButton(data.bufferkN_img, data.bufferSPath_str, undefined,
					true,
					data.useHEXColorsForSkin_bl,
					data.normalButtonsColor_str,
					data.selectedButtonsColor_str);
			self.bufferButton_do.addListener(FWDUVPSimpleButton.MOUSE_UP, self.bufferOnMouseUpHandler);
			this.buttons_ar.push(self.bufferButton_do);
			
			FWDUVPSimpleButton.setPrototype();
			self.diggButton_do = new FWDUVPSimpleButton(data.diggN_img, data.diggSPath_str, undefined,
					true,
					data.useHEXColorsForSkin_bl,
					data.normalButtonsColor_str,
					data.selectedButtonsColor_str);
			self.diggButton_do.addListener(FWDUVPSimpleButton.MOUSE_UP, self.diggOnMouseUpHandler);
			this.buttons_ar.push(self.diggButton_do);
			
			FWDUVPSimpleButton.setPrototype();
			self.redditButton_do = new FWDUVPSimpleButton(data.redditN_img, data.redditSPath_str, undefined,
					true,
					data.useHEXColorsForSkin_bl,
					data.normalButtonsColor_str,
					data.selectedButtonsColor_str);
			self.redditButton_do.addListener(FWDUVPSimpleButton.MOUSE_UP, self.redditOnMouseUpHandler);
			this.buttons_ar.push(self.redditButton_do);
			
			FWDUVPSimpleButton.setPrototype();
			self.thumbrlButton_do = new FWDUVPSimpleButton(data.thumbrlN_img, data.thumbrlSPath_str, undefined,
					true,
					data.useHEXColorsForSkin_bl,
					data.normalButtonsColor_str,
					data.selectedButtonsColor_str);
			self.thumbrlButton_do.addListener(FWDUVPSimpleButton.MOUSE_UP, self.thumbrlOnMouseUpHandler);
			this.buttons_ar.push(self.thumbrlButton_do);
			
			
			self.mainHolder_do.addChild(self.facebookButton_do);
			self.mainHolder_do.addChild(self.googleButton_do);
			self.mainHolder_do.addChild(self.twitterButton_do);
			self.mainHolder_do.addChild(self.likedinButton_do);
			self.mainHolder_do.addChild(self.bufferButton_do);
			self.mainHolder_do.addChild(self.diggButton_do);
			self.mainHolder_do.addChild(self.redditButton_do);
			self.mainHolder_do.addChild(self.thumbrlButton_do);
		}
		
		this.facebookOnMouseUpHandler = function(){
			var url = "http://www.facebook.com/share.php?u=" + encodeURIComponent(location.href);
			window.open(url,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=600');
		};
		
		this.googleOnMouseUpHandler = function(){
			var url = "https://plus.google.com/share?url=" + encodeURIComponent(location.href)
			window.open(url,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=600');
		};
		
		this.twitterOnMouseUpHandler = function(){
			var url = "http://twitter.com/home?status=" + encodeURIComponent(location.href)
			window.open(url,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=600');
		};
		
		this.likedinOnMouseUpHandler = function(){
			var url = "https://www.linkedin.com/cws/share?url=" + location.href;
			window.open(url,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=600');
		};
		
		this.bufferOnMouseUpHandler = function(){
			var url = "https://buffer.com/add?url=" + location.href;
			window.open(url,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=600');
		};
		
		this.diggOnMouseUpHandler = function(){
			var url = "http://digg.com/submit?url=" + location.href;
			window.open(url,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=600');
		};
		
		this.redditOnMouseUpHandler = function(){
			var url = "https://www.reddit.com/?submit=" + location.href;
			window.open(url,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=600');
		};
		
		this.thumbrlOnMouseUpHandler = function(){
			var url = "http://www.tumblr.com/share/link?url=" + location.href;
			window.open(url,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=600');
		};
	
		
		//########################################//
		/* Position buttons */
		//########################################//
		this.positionButtons = function(){
			var button;
			var prevButton;
			var rowsAr = [];
			var rowsWidthAr = [];
			var rowsThumbsWidthAr = [];
			var tempX;
			var tempY = 0;
			var maxY = 0;
			var totalRowWidth = 0;
			var rowsNr = 0;
			
			rowsAr[rowsNr] = [0];
			rowsWidthAr[rowsNr] = self.buttons_ar[0].totalWidth;
			rowsThumbsWidthAr[rowsNr] = self.buttons_ar[0].totalWidth;
			self.totalButtons = self.buttons_ar.length;
			
			for (var i=1; i<self.totalButtons; i++){
				button = self.buttons_ar[i];
				
				if (rowsWidthAr[rowsNr] + button.totalWidth + self.minHSpace > self.stageWidth - self.minMarginXSpace){	
					rowsNr++;
					rowsAr[rowsNr] = [];
					rowsAr[rowsNr].push(i);
					rowsWidthAr[rowsNr] = button.totalWidth;
					rowsThumbsWidthAr[rowsNr] = button.totalWidth;
				}else{
					rowsAr[rowsNr].push(i);
					rowsWidthAr[rowsNr] += button.totalWidth + self.minHSpace;
					rowsThumbsWidthAr[rowsNr] += button.totalWidth;
				}
			}
		
			tempY = parseInt((self.stageHeight - ((rowsNr + 1) * (button.totalHeight + self.vSpace) - self.vSpace))/2);
			
			for (var i=0; i<rowsNr + 1; i++){
				var rowMarginXSpace = 0;
				
				var rowHSpace;
				
				if (rowsAr[i].length > 1){
					rowHSpace = Math.min((self.stageWidth - self.minMarginXSpace - rowsThumbsWidthAr[i]) / (rowsAr[i].length - 1), self.hSpace);
					
					var rowWidth = rowsThumbsWidthAr[i] + rowHSpace * (rowsAr[i].length - 1);
					
					rowMarginXSpace = parseInt((self.stageWidth - rowWidth)/2);
				}else{
					rowMarginXSpace = parseInt((self.stageWidth - rowsWidthAr[i])/2);
				}
				
				if (i > 0) tempY += button.h + self.vSpace;
				
				for (var j=0; j<rowsAr[i].length; j++){
					button = self.buttons_ar[rowsAr[i][j]];
				
					if (j == 0){
						tempX = rowMarginXSpace;
					}else{
						prevButton = self.buttons_ar[rowsAr[i][j] - 1];
						tempX = prevButton.finalX + prevButton.totalWidth + rowHSpace;
					}
					

					button.finalX = tempX;
					button.finalY = tempY;
						
					if (maxY < button.finalY) maxY = button.finalY;
					
					self.buttonsBarTotalHeight = maxY + button.totalHeight + self.startY ;
					button.setX(button.finalX);
					button.setY(button.finalY);
				}
			}
		}
		
		
		
		//###########################################//
		/* show / hide */
		//###########################################//
		this.show = function(id){
			if(self.isShowed_bl) return;
			self.isShowed_bl = true;
			parent.main_do.addChild(self);
		
			
			//if(!FWDUVPUtils.isMobile || (FWDUVPUtils.isMobile && FWDUVPUtils.hasPointerEvent)) parent.main_do.setSelectable(true);
			self.positionAndResize();
			
			clearTimeout(self.hideCompleteId_to);
			clearTimeout(self.showCompleteId_to);
			self.mainHolder_do.setY(- self.stageHeight);
			
			self.showCompleteId_to = setTimeout(self.showCompleteHandler, 900);
			setTimeout(function(){
				FWDAnimation.to(self.mainHolder_do, .8, {y:0, delay:.1, ease:Expo.easeInOut});
			}, 100);
		};
		
		this.showCompleteHandler = function(){};
		
		this.hide = function(){
			if(!self.isShowed_bl) return;
			self.isShowed_bl = false;
			
			if(parent.customContextMenu_do) parent.customContextMenu_do.enable();
			self.positionAndResize();
			
			clearTimeout(self.hideCompleteId_to);
			clearTimeout(self.showCompleteId_to);
			
			//if(!FWDUVPUtils.isMobile || (FWDUVPUtils.isMobile && FWDUVPUtils.hasPointerEvent)) parent.main_do.setSelectable(false);
			self.hideCompleteId_to = setTimeout(self.hideCompleteHandler, 800);
			FWDAnimation.killTweensOf(self.mainHolder_do);
			FWDAnimation.to(self.mainHolder_do, .8, {y:-self.stageHeight, ease:Expo.easeInOut});
		};
		
		this.hideCompleteHandler = function(){
			parent.main_do.removeChild(self);
			self.dispatchEvent(FWDUVPShareWindow.HIDE_COMPLETE);
		};
		
		//##########################################//
		/* Update HEX color of a canvaas */
		//##########################################//
		this.updateHEXColors = function(normalColor_str, selectedColor_str){
			
			if(data.skinPath_str.indexOf("hex_white") != -1){
				self.selectedColor_str = "#FFFFFF";
			}else{
				self.selectedColor_str = selectedColor_str;
			}
			
			self.closeButton_do.updateHEXColors(normalColor_str, self.selectedColor_str);
			self.facebookButton_do.updateHEXColors(normalColor_str, selectedColor_str);
			self.googleButton_do.updateHEXColors(normalColor_str, selectedColor_str);
			self.twitterButton_do.updateHEXColors(normalColor_str, selectedColor_str);
			self.likedinButton_do.updateHEXColors(normalColor_str, selectedColor_str);
			self.bufferButton_do.updateHEXColors(normalColor_str, selectedColor_str);
			self.diggButton_do.updateHEXColors(normalColor_str, selectedColor_str);
			self.redditButton_do.updateHEXColors(normalColor_str, selectedColor_str);
			self.thumbrlButton_do.updateHEXColors(normalColor_str, selectedColor_str);
		}
		
		
		
		this.init();
	};
		
	/* set prototype */
	FWDUVPShareWindow.setPrototype = function(){
		FWDUVPShareWindow.prototype = new FWDUVPDisplayObject("div");
	};
	
	FWDUVPShareWindow.HIDE_COMPLETE = "hideComplete";
	
	FWDUVPShareWindow.prototype = null;
	window.FWDUVPShareWindow = FWDUVPShareWindow;
}(window));