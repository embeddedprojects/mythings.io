var cur=0;
var tweets_array=Array();
var obj;
var limit=0;
var stopFirstTimer=false;
(function($){  
	//Attach this new method to jQuery  
	$.fn.extend({
		topnews:function(options)
		{
			 var defaults = {  
				startstop: false,
				limit:10
			 };
			options=$.extend({},defaults,options);	
 			limit=options.limit;
			return this.each(function()
			{
				obj =$(this).attr("id");
				
				if(!obj)
					obj="."+$(this).attr('class');
				else
					obj="#"+$(this).attr(id);
			
				var first_child=$(this+" div:#tweet_container")
				$.ajax({
					type:"post",
					url:"ajax_server.php",
					data: "functionName=get_recent_tweet&lim="+limit,
					success:function(msg){
						tweets_array=msg.split("~");
						while(cur<tweets_array.length)
						{
							var msg1="<div id='tweet_container'><div id='tweet-content'>"+tweets_array[cur]+"</div></div>";
							$(obj).prepend(msg1);
							cur++;
						}
					}
				});
				
				$(this).hover(function(){
					if(options.startstop)
					{
						clearInterval(tweet_scroller_time);
						clearInterval(tweet_get_time=setInterval);
					}
					stopFirstTimer=true;
				});
				$(this).mouseleave(function(){
					tweet_scroller_time=setInterval('if(cur==limit)cur=0; $(obj+" div:last").remove();var msg1="<div id=\'tweet_container\' style=\'display:none;height:50px;\'></div>";var msg2="<div id=\'tweet-content\' style=\'display:none;\'>"+tweets_array[cur]+"</div>";$(obj).prepend(msg1);$(obj+" div:#tweet_container").slideDown(1500);$(obj+" div:#tweet_container").prepend(msg2);show_now_timer=setTimeout(\'$(obj+" div:#tweet_container div").fadeIn();\',1500);$(obj+" div:last").remove();cur++;', 4000);
				});
				if(stopFirstTimer==false)
				{
					//show tweet one by one 
					tweet_scroller_time=setInterval('if(cur==limit)cur=0;$(obj+" div:last").remove();var msg1="<div id=\'tweet_container\' style=\'display:none;height:50px;\'></div>";var msg2="<div id=\'tweet-content\' style=\'display:none;\'>"+tweets_array[cur]+"</div>";$(obj).prepend(msg1);$(obj+" div:#tweet_container").slideDown(1500);$(obj+" div:#tweet_container").prepend(msg2);show_now_timer=setTimeout(\'$(obj+" div:#tweet_container div").fadeIn();\',1500);$(obj+" div:last").remove();cur++;', 4000);
				}
				//get tweet from database after some time interval
				tweet_get_time=setInterval('$.ajax({type:"post",url:"ajax_server.php",data: "functionName=get_recent_tweet&lim="+limit,success:function(msg){tweets_array=msg.split("~");}});', options.limit*4000);
			});
		}
	});
})(jQuery);

/* vertical scroller start */
/*function get_tweet(lim)
{
	$.ajax({
		type:"post",
		url:'ajax_server.php',
		data: "functionName=get_recent_tweet&lim="+lim,
		success:function(msg){
			tweets_array=msg.split("~");
		}
	});
}
function show_tweet_onload(obj)
{
	while(cur<tweets_array.length)
	{
		var msg1="<div id='tweet_container'></div>";
		var msg2="<div id='tweet-content'>"+tweets_array[cur]+"</div>";
		$(".twtr-tweets").prepend(msg1);
		$(".twtr-tweets div:#tweet_container").prepend(msg2);
		cur++;
	}
}
function show_tweet(obj)
{
	if(cur==lim)
		cur=0;
	var msg1="<div id='tweet_container' style='display:none;height:50px;'></div>";
	var msg2="<div id='tweet-content' style='display:none;'>"+tweets_array[cur]+"</div>";
	$(obj).prepend(msg1);
	$(obj+" div:#tweet_container").slideDown(1500);
	$(obj+" div:#tweet_container").prepend(msg2);
	show_now_timer=setTimeout('$(obj+" div:#tweet_container div").fadeIn();',1500);
	$(obj+" div:last").remove();
	cur++;
}
function show_now(obj)
{
	$(obj+" div:#tweet_container div").fadeIn();
}
*/
