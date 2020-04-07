// JavaScript Document

var zep = "__proto__" in window;
var cdnPath = 'http://cdnjs.cloudflare.com/ajax/libs/';
var localPath = "/wp-content/themes/charles-child/";
 
Modernizr.load([
	{
	    test:     zep,
	    yep:      cdnPath + 'zepto/1.0/zepto.min.js',
	    nope:     [cdnPath + 'jquery/1.10.2/jquery.min.js', cdnPath + 'jquery-migrate/1.2.1/jquery-migrate.min.js'],
	    complete: function () { //load local versions
	        if (zep && !window.Zepto) {
	        	Modernizr.load(localPath + 'library/zepto-1.0.min.js');
	        }	    	
	        if (!zep && !window.jQuery) {
	        	Modernizr.load(localPath + 'library/jquery-1.10.2.min.js');
	        }
	    }
	},{
		load: localPath + 'js/utility.js' 	       
	},{
	    test:     Modernizr.touch, //Yes, I know it's bad, but I'm demostrating JS loading here, geez!!!
	    yep:      [localPath + 'library/zepto.touch.min.js', localPath + 'library/zepto.history.min.js'],	    
	    nope:     '',
	    complete: function () {
	        if (Modernizr.touch) {
	        	Modernizr.load(localPath + 'js/touch.js');
	        }
	    }	    
	}
]);