// -----------------------------------------------------------------------------------
//
//	Bubble beta1
//	by Albert Lanchas - http://www.albertlanchas.com
//	24/09/2006
//
//	For more information on this script, visit:
//	http://www.albertlanchas.com/bubble/
//
//	Licensed under the Creative Commons Attribution 2.5 License - http://creativecommons.org/licenses/by/2.5/
//	
//	Credit also due to Lokesh Dhakar (http://www.huddletogether.com)
//
// -----------------------------------------------------------------------------------

//
//	Configuration
//
// distance from left border to bubble point. Change this if you use a different bottom left image.
var distanceToBubblePoint = 34; 

//if you adjust the margins in the CSS, you will need to update these variables
var imageMarginLeft = 22; 
var imageMarginRight = 28; // 22 + 6px shadow
var imageBorder = 1;

// -----------------------------------------------------------------------------------

var Bubble = Class.create();

Bubble.prototype = {
	//
	// initialize()
	// Constructor runs on completion of the DOM loading. Loops through anchor tags looking for 
	// 'bubble' references and applies onmouseover and onmouseout events to appropriate links. 
	// The 2nd section of the function inserts html at the bottom of the page which is used to 
	// display the bubble box and the image container.
	//
	initialize: function() {
		if (!document.getElementsByTagName){ return; }
		var anchors = document.getElementsByTagName('a');

		// loop through all anchor tags
		for (var i=0; i<anchors.length; i++){
			var anchor = anchors[i];
			
			var relAttribute = String(anchor.getAttribute('rel'));
			
			// use the string.match() method to catch 'bubble' references in the rel attribute
			if (anchor.getAttribute('href') && (relAttribute.toLowerCase().match('bubble'))){
				anchor.onmouseover = function () {myBubble.show(this); return false;}
				anchor.onmouseout = function () {myBubble.hide(); return false;}
				anchor.onclick = function () {return false;}
			}
		}
		
		// The rest of this code inserts html at the bottom of the page that looks similar to this:
		
		//	<div id="bubble">
		//		<div class="Article">
		//			<div class="ArticleHeader" id="ArticleHeader"></div>
		//			<div class="ArticleBody" id="ArticleBody"></div>
		//			<div class="ArticleFooter" id="ArticleFooter">
		//				<div class="ArticleFooterBottomRight"></div>
		//			</div>
		//			<div class="ArticleFooterTail" id="ArticleFooterTail"></div>
		//		</div>
		//	</div>
		
		var objBody = document.getElementsByTagName("body").item(0);
		
		var objBubble = document.createElement("div");
		objBubble.setAttribute('id','bubble');
		objBody.appendChild(objBubble);
		
		var objArticle = document.createElement("div");
		objArticle.className = 'Article';
		objBubble.appendChild(objArticle);
		
		var objArticleHeader = document.createElement("div");
		objArticleHeader.setAttribute('id','ArticleHeader');
		objArticleHeader.className = 'ArticleHeader';
		objArticle.appendChild(objArticleHeader);

		var objArticleBody = document.createElement("div");
		objArticleBody.className = 'ArticleBody';
		objArticleBody.setAttribute('id','ArticleBody');
		objArticle.appendChild(objArticleBody);
		
		var objArticleFooter = document.createElement("div");
		objArticleFooter.className = 'ArticleFooter';
		objArticleFooter.setAttribute('id','ArticleFooter');
		objArticle.appendChild(objArticleFooter);

		var objArticleFooterBottomRight = document.createElement("div");
		objArticleFooterBottomRight.className = 'ArticleFooterBottomRight';
		objArticleFooter.appendChild(objArticleFooterBottomRight);

		var objArticleFooterTail = document.createElement("div");
		objArticleFooterTail.className = 'ArticleFooterTail';
		objArticleFooterTail.setAttribute('id','ArticleFooterTail');
		objArticle.appendChild(objArticleFooterTail);
	},
	//
	//	hide()
	//	displays the bubble box
	//
	show: function(anchor) {
		var imgsrc = anchor.getAttribute('href');
		var objArticleBody = $("ArticleBody");
		var objBubbleImage = $("bubbleImg");
		if (objBubbleImage == null) {
			objBubbleImage = document.createElement("img");
			objBubbleImage.setAttribute('id','bubbleImg');
			objArticleBody.appendChild(objBubbleImage);
		}
		imgPreloader = new Image();
		
		imgPreloader.onload=function(){
			objBubbleImage.setAttribute('src',imgsrc);
			myBubble.resizeImageContainer(imgPreloader, anchor.firstChild);
		}
		imgPreloader.src = imgsrc;
	},
	//
	//	hide()
	//	hides the bubble box
	//
	hide: function() {
		var objBubble = $("bubble");
		objBubble.style.display = "none";
	},
	//
	//	resizeImageContainer()
	//	resizes the bubble box and calculates the left and top coordinates
	//
	resizeImageContainer: function(img, imgZoom) {
		// get icon's position 
		var coord = getPos(imgZoom);
		
		// get header, footer and tail height from css
		var objArticleHeader = $("ArticleHeader");
		var topLeftHeight = getValuePxString(getCSSProp(objArticleHeader,"height"));		
		var paddingHeaderRight = getValuePxString(getCSSProp(objArticleHeader,"right"));
		var objArticleFooter = $("ArticleFooter");
		var bottomLeftHeight = getValuePxString(getCSSProp(objArticleFooter,"height"));
		var objArticleFooterTail = $("ArticleFooterTail");
		var bottomLeftTail = getValuePxString(getCSSProp(objArticleFooterTail,"height"));
		
		var objBubble = $("bubble");
		objBubble.style.width = imageMarginLeft + img.width + (imageBorder * 2) + imageMarginRight + parseInt(paddingHeaderRight) + "px";
		objBubble.style.top = coord.top - (parseInt(topLeftHeight) + img.height + (imageBorder * 2) + parseInt(bottomLeftHeight) + parseInt(bottomLeftTail)) + "px";
		objBubble.style.left = coord.left + imgZoom.width - distanceToBubblePoint + "px";
		objBubble.style.display = "block";
	}
}

// -----------------------------------------------------------------------------------
//
// Miscellaneous Functions
//
// -----------------------------------------------------------------------------------

//
// Obtains the absolute position of a given element.
//
function getPos(obj) {
  var coord = new Object();
  o = obj;
  coord.left = o.offsetLeft;
  coord.top = o.offsetTop;
  while(o.offsetParent != null) {
    oParent = o.offsetParent;
    coord.left += oParent.offsetLeft;
    coord.top += oParent.offsetTop;
    o = oParent;
  }
  return coord;
}

// -----------------------------------------------------------------------------------

//
// Obtains the number value of a px string
//

function getValuePxString(str) {
	var ind = str.indexOf("px");
	return str.substring(0,ind);
}

// -----------------------------------------------------------------------------------

// Name: Get CSS Property
// Language: JavaScript
// Author: Travis Beckham | squidfingers.com
// Description: Retrieve a CSS property from inline and external sources
// Compatibility: IE4+, NS6+, Safari 1.3+
// --------------------------------------------------

function getCSSProp (element, prop) {
  if (element.style[prop]) {
    // inline style property
    return element.style[prop];
  } else if (element.currentStyle) {
    // external stylesheet for Explorer
    return element.currentStyle[prop];
  } else if (document.defaultView && document.defaultView.getComputedStyle) {
    // external stylesheet for Mozilla and Safari 1.3+
    prop = prop.replace(/([A-Z])/g,"-$1");
    prop = prop.toLowerCase();
    return document.defaultView.getComputedStyle(element,"").getPropertyValue(prop);
  } else {
    // Safari 1.2
    return null;
  }
}

// -----------------------------------------------------------------------------------

function initBubble() { myBubble = new Bubble(); }
Event.observe(window, 'load', initBubble, false);