
var offsetX = 10;
var offsetY = 12;
var mesures = [];
var mesureClicked = [];
var badgeClicked = [];
var scrollDisabled = false;
var comboWidth = 293;
var comboHeight = 157;
var xp;

//  Screen Dimensions
function SW(){	return $( window ).width();	}
function SH(){	return $( window ).height();}


// ANIMATIONS
(function($){

	$.Animation = function(_target,_frameSize,_stopAtFrame,_speed,_onEnd='') {
		this.Target;
		if(_target.jquery){
			this.Target=_target;
		}else{
			this.Target=_target.element;
		}
		this.FrameSize = _frameSize;
		this.FrameStop = _stopAtFrame;
		this.Speed = _speed;
		this.OnEnd = _onEnd;
		this.Frame = 0;
		this.loop = null;
		this.Start();
	};

	$.Animation.prototype = {
		Start: function() {
			this.loop = setInterval(this.Animate, this.Speed, this );
		},
		Animate: function(A){
			if(A.Frame>=A.FrameStop){
				switch(A.OnEnd){
					case'delete':
						A.Target.remove();
						break;
					case'incrementXP':
						xp.Up();
						break;
					default:
						break;
				}
				clearInterval(A.loop);
				return;
			}
			$(A.Target).css('background-position', (-A.Frame*A.FrameSize)+'px 0px');
			A.Frame++;
		}
	};

}(jQuery));








(function(e){"use strict";function r(t,n){this.opts=e.extend({handleKeys:!0,scrollEventKeys:[32,33,34,35,36,37,38,39,40]},n);this.$container=t;this.$document=e(document);this.lockToScrollPos=[0,0];this.disable()}var t,n;n=r.prototype;n.disable=function(){var e=this;e.lockToScrollPos=[e.$container.scrollLeft(),e.$container.scrollTop()];e.$container.on("mousewheel.disablescroll DOMMouseScroll.disablescroll touchmove.disablescroll",e._handleWheel);e.$container.on("scroll.disablescroll",function(){e._handleScrollbar.call(e)});e.opts.handleKeys&&e.$document.on("keydown.disablescroll",function(t){e._handleKeydown.call(e,t)})};n.undo=function(){var e=this;e.$container.off(".disablescroll");e.opts.handleKeys&&e.$document.off(".disablescroll")};n._handleWheel=function(e){e.preventDefault()};n._handleScrollbar=function(){this.$container.scrollLeft(this.lockToScrollPos[0]);this.$container.scrollTop(this.lockToScrollPos[1])};n._handleKeydown=function(e){for(var t=0;t<this.opts.scrollEventKeys.length;t++)if(e.keyCode===this.opts.scrollEventKeys[t]){e.preventDefault();return}};e.fn.disablescroll=function(e){!t&&(typeof e=="object"||!e)?t=new r(this,e):t&&t[e]&&t[e].call(t)};window.UserScrollDisabler=r})(jQuery);