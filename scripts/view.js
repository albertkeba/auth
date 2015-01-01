/*jslint white: true*/
/*global $*/
var View = (function(){
	'use strict';
	function Class( options ){
		options = options || {};
		
		this.id			= options.id		|| null;
		this.className	= options.className	|| null;
		this.$el		= options.el ? $( options.el ) : null;
		this.events		= options.events || null;
	}
	
	Class.prototype.constructor = View;
	
	Class.prototype.bindEvents = function() {
		var events = this.events, key, el, element = null;
	
		for ( key in events )
		{
			if ( events.hasOwnProperty(key) )
			{
				for ( el in events[key] )
				{
					if ( ( events[key]).hasOwnProperty(el) )
					{
						element = this.$el.find( events[key][el].element, this );
					}
					
					element.on( key,{self:this},this[events[key][el].attach] );
				}
			}
		}
	};
	
	return Class;
}());