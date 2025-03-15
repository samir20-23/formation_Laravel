import './bootstrap'; 

$(document).ready(function(){
  function loadPosts(query){
    $.ajax({
      url:"/posts",
      data:{search:query},
      success:function(data){
        var html="";
        data.forEach(function(post){
          html+="<div data-id='"+post.id+"'><h3>"+post.title+"</h3><p>"+post.content+"</p><button class='edit btn btn-primary'>Edit</button> <button class='delete btn btn-danger'>Delete</button></div>";
        });
        $("#posts").html(html);
      }
    });
  }
  $("#load").click(function(){
    loadPosts($("#search").val());
  });
  $("#postForm").submit(function(e){
    e.preventDefault();
    if($("#post_id").val()==""){
      $.ajax({
        url:"/posts",
        method:"POST",
        data:$(this).serialize(),
        success:function(data){
          loadPosts("");
          $("#postForm")[0].reset();
        }
      });
    }
  });
  $(document).on("click", ".delete", function(){
    var id = $(this).parent().data("id");
    $.ajax({
      url:"/posts/"+id,
      method:"DELETE",
      data:{_token:$("meta[name='csrf-token']").attr("content")},
      success:function(data){
        loadPosts("");
      }
    });
  });
  $(document).on("click", ".edit", function(){
    var id = $(this).parent().data("id");
    $.ajax({
      url:"/posts/"+id,
      method:"GET",
      success:function(data){
        $("#post_id").val(data.id);
        $("#title").val(data.title);
        $("#content").val(data.content);
        $("#save").hide();
        $("#update").show();
        $("#cancel").show();
      }
    });
  });
  $("#update").click(function(){
    var id = $("#post_id").val();
    $.ajax({
      url:"/posts/"+id,
      method:"PUT",
      data:$("#postForm").serialize(),
      success:function(data){
        loadPosts("");
        $("#postForm")[0].reset();
        $("#save").show();
        $("#update").hide();
        $("#cancel").hide();
      }
    });
  });
  $("#cancel").click(function(){
    $("#postForm")[0].reset();
    $("#save").show();
    $("#update").hide();
    $("#cancel").hide();
  });
  $("#importForm").submit(function(e){
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
      url:"/posts-import",
      method:"POST",
      data:formData,
      processData:false,
      contentType:false,
      success:function(data){
        loadPosts("");
      }
    });
  });
});

  