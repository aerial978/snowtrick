/* Fixed navbar */
var nav = document.querySelector('nav');

window.addEventListener('scroll', function () {
if (window.scrollY > 100) {
nav.classList.add('bg-dark', 'shadow');
} else {
nav.classList.remove('bg-dark', 'shadow');
}
});

/* (1) Index xl-size displayPicture.html.twig */

$('.img-thumbnail').on('click',function(){
    let pictureSrc = $(this).attr('src');
    $('.modal-img').attr('src',pictureSrc);
});

/*  (2) Index mediaDisplayResponsive.html.twig */

$('.gallery-item').on('click',function(){
    let pictureLink = $(this).attr('data-link');
    let img = document.createElement('img');
    img.src = pictureLink;
    img.className = 'img-fluid modal-img';
    $('#exampleModal .modal-body').html(img);
});

$('.video-item').on('click',function(){
    let videoLink = $(this).attr('data-link');
    let video = document.createElement('iframe');
    video.src = 'https://www.youtube.com/embed/'+videoLink;
    video.id = "modal-video";
    video.width = "300";
    video.height = "205";
    video.title = "YouTube video player";
    video.frameborder = "0";
    video.allow = "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture";
    video.allowfullscreen = 'true';
    $('#exampleModal .modal-body').html(video);
});

/*  (3) New trick - Multi-upload video */

$(document).ready(function(){
    $("#addmorebtn").click(function(){
        $(".inputVideoType .duplicate-row:first").clone().appendTo(".inputVideoType");
        $(".inputVideoType .duplicate-row:last input").val("");
    /*    let lastQtyInputIndex = $('.duplicate-row').length - 1;
        $('.duplicate-row input')[lastQtyInputIndex].value = '';
        console.log($('.duplicate-row')[1]);*/
    });
    
    $(document).on('click','.btn-remove',function(){
        if($(".inputVideoType .duplicate-row").length > 1)
        {
            $(this).parents(".duplicate-row").remove();
        }
    });    
});










