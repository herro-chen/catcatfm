$(document).ready(function(){var A=$("#message-success"),B=$("#message-warning");C();function C(){$.ajax({url:Home+"admin.php?c=board&m=empty_message",type:"GET",success:function(D){setTimeout(function(){A.hide();B.hide()},3000)}})}});