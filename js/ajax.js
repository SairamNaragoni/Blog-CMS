//script to implement comments
$('#do_comment').click(
	function(event){
		event.preventDefault();
		var post_id = $('.post_id').val();
		$.ajax({
			url: "ajax/comment.php",
			method: "post",
			data : $('form').serialize()+'&post_id='+post_id,
			success: function(response){
					$('#post_comment').val('');
					$('.comments').append(response);
			},
			error : function(jqXHR, textStatus, errorThrown){
					console.log(textStatus, errorThrown);

			}
	});
	return false;
});

//function to get id from url
$.urlParam = function(name){
	var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
	return results[1] || 0;
}

//ajax script for follow/unfollow
$('#do_follow').click(
	function(event){
	event.preventDefault();
	var parent_id = $.urlParam('id');
	var ftype = $('#do_follow').text();
	var count = $('#follower_count').text();
	count = parseInt(count);
	$.ajax({
		url: "ajax/follow.php",
		method: "post",
		data: '&parent_id='+parent_id+'&ftype='+ftype,
		success: function(response){
				$('#do_follow').text(response);
				if(response=="Follow")
				{
					$('#follower_count').text(count-1);
				}
				else
				{
					$('#follower_count').text(count+1);
				}
		},
		error : function(jqXHR, textStatus, errorThrown){
					console.log(textStatus, errorThrown);
			}
	});
	return false;

});
//ajax script for search bar
$('#search_bar').keyup(
	function(event){
		var val = $(this).val();
		$.ajax({
			url: "ajax/search.php",
			method: "post",
			data: '&val='+val,
			dataType: 'html',
			success: function(response){
					$('#search_result').html(response);
			},
			error : function(jqXHR,textStatus,errorThrown){
						console.log(textStatus,errorThrown);
			}
		});
});
$('#search_bar').focusout(function(){
	var val = $(this).val();
	if(val == '')
	{
		$('#search_result').html('');
	}
});

window.setInterval(function(){
  $.refreshNotifications();
}, 100);

$.refreshNotifications = function(){
	$.ajax({
		url: "ajax/refresh.php",
		method : "post",
		success: function(response){
			if(response != 0)
				$('#unread_count').text(response);
			else
				$('#unread_count').text('');
		},
		error : function(jqXHR,textStatus,errorThrown){
			console.log(textStatus,errorThrown);
		}
	});
};

$('#notify').click(function(){
	$.ajax({
		url: "ajax/notification.php",
		method:"post",
		dataType: 'html',
		success: function(response){
			$('#notifications_drop').html(response);
			$('#unread_count').text('');
		},
		error : function(jqXHR,textStatus,errorThrown){
			console.log(textStatus,errorThrown);
		}
	});
});


$('.like').click(function(event){
	event.preventDefault();
	var thi = $(this);
	var ids = $(this).attr('href');
	var href = ids.split(',');
	var post_id = href[1];
	var parent_id = href[0];
	var ftype = $(this).text();
	$.ajax({
		url: "ajax/like.php",
		method: "post",
		data: '&post_id='+post_id+'&parent_id='+parent_id+'&ftype='+ftype,
		success: function(response){
			thi.text(response);
		},
		error : function(jqXHR,textStatus,errorThrown){
			console.log(textStatus,errorThrown);
		}
	});
});

$('.like').hover(function(event){
	var thi = $(this);
	var ids = $(this).attr('href');
	var href = ids.split(',');
	var post_id = href[1];
	$.ajax({
		url: "ajax/refresh-like.php",
		method: "post",
		data: '&post_id='+post_id,
		success: function(response){
			thi.attr("data-content",response);
		},
		error : function(jqXHR,textStatus,errorThrown){
			console.log(textStatus,errorThrown);
		}
	});
});



$(function () {
  $('[data-toggle="popover"]').popover()
});
